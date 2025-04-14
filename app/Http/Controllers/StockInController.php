<?php

namespace App\Http\Controllers;

use App\Models\products; // Corrected model name: Product (singular, StudlyCase)
use App\Models\stockin;
use Illuminate\Http\Request;
use App\Models\stock;

class StockInController extends Controller
{
    public function create()
    {
        // Fetch all products
        $products = products::all(); 
        return view('inventory.stockin', compact('products')); // Pass products to the view
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id', // ✅ assuming your products table uses 'id'
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
        ], [
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'Selected product does not exist.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0.01.',
        ]);
    
        // Create a new StockIn record
        stockin::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        // Update stock quantity (increase by stockin quantity)
        $stock = Stock::where('product_id', $request->product_id)->first();
    
        if ($stock) {
            // If the stock already exists for the product, update the quantity
            $stock->quantity += $request->quantity;
            $stock->save();
        } else {
            // If the stock record doesn't exist, create a new one
            Stock::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
    
        // Redirect with a success message
        return redirect()->route('stockin.view')->with('success', 'Stock In created and stock updated successfully!');
    }
    
        public function show(){
        $products=stockin::all();
        return view('inventory.stockinselect',compact('products'));
    }



    public function delete(Stockin $stockin)
    {
        // Subtract the deleted quantity from the stock
        $stock = Stock::where('product_id', $stockin->product_id)->first();
    
        if ($stock) {
            // If stock record exists, reduce the quantity by the deleted quantity
            $stock->quantity -= $stockin->quantity;
            // Ensure the quantity doesn't go negative
            $stock->quantity = max($stock->quantity, 0); 
            $stock->save();
        }
    
        // Delete the StockIn record
        $stockin->delete();
    
        // Redirect with a success message
        return redirect()->route('stockin.view')->with('success', 'Product deleted and stock updated successfully.');
    }



    public function edit(Stockin $stockin)
    {
        $products = Products::all(); // Fetch all products
        return view('inventory.stockinupdate', [
            'stockin' => $stockin,
            'products' => $products
        ]);
    }



    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        // Find the stockin record
        $stockin = Stockin::findOrFail($id);
    
        // Get the previous quantity (before update)
        $previousQuantity = $stockin->quantity;
    
        // Get the product associated with this stockin (optional, if needed)
        $product = $stockin->product; // assuming you have a relationship defined
    
        // Update stockin fields
        $stockin->product_id = $request->input('product_id');
        $stockin->quantity = $request->input('quantity');
        $stockin->price = $request->input('price');
        $stockin->save();
    
        // Get the stock record for the product
        $stock = Stock::where('product_id', $request->input('product_id'))->first();
    
        if ($stock) {
            // Calculate the difference in quantity
            $quantityDifference = $request->input('quantity') - $previousQuantity;
    
            // Update the stock quantity based on the difference
            $stock->quantity += $quantityDifference;
            $stock->save();
        } else {
            // Optionally, handle the case where no stock record is found for the product
            return redirect()->route('stockin.view')->with('error', 'Stock record not found!');
        }
    
        // Redirect with success message
        return redirect()->route('stockin.view')->with('success', 'Stock In updated successfully and stock adjusted!');
    }
    
}
