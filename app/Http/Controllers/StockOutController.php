<?php

namespace App\Http\Controllers;

use App\Models\stockout;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\stock;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = products::all(); 
        return view('inventory.stockout', compact('products')); // Pass products to the view
    }

    /**
     * Store a newly created resource in storage.
     */
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
    
        // Create a new StockOut record (you can change 'StockOut' to the actual model name)
        Stockout::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        // Update stock quantity (decrease by stockout quantity)
        $stock = Stock::where('product_id', $request->product_id)->first();
    
        if ($stock) {
            // If the stock exists for the product, decrease the quantity
            if ($stock->quantity >= $request->quantity) {
                $stock->quantity -= $request->quantity;
                $stock->save();
            } else {
                // If there's not enough stock, throw an error or return a message
                return redirect()->back()->withErrors(['quantity' => 'Insufficient stock for the selected product.']);
            }
        } else {
            // If the stock record doesn't exist, return an error
            return redirect()->back()->withErrors(['stock' => 'No stock record found for this product.']);
        }
    
        // Redirect with a success message
        return redirect()->route('stockout.view')->with('success', 'Stock Out created and stock updated successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(){
        $products=stockout::all();
        return view('inventory.stockoutselect',compact('products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockout $stockout)
    {
        $products = Products::all(); // Fetch all products
        return view('inventory.stockoutupdate', [
            'stockout' => $stockout,
            'products' => $products
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        // Find the stockout record
        $stockout = Stockout::findOrFail($id);
    
        // Get the previous quantity (before update)
        $previousQuantity = $stockout->quantity;
    
        // Update stockout fields
        $stockout->product_id = $request->input('product_id');
        $stockout->quantity = $request->input('quantity');
        $stockout->price = $request->input('price');
        $stockout->save();
    
        // Get the stock record for the product
        $stock = Stock::where('product_id', $request->input('product_id'))->first();
    
        if ($stock) {
            // Calculate the quantity difference (new - old)
            $quantityDifference = $request->input('quantity') - $previousQuantity;
    
            // Subtract the difference from stock (since it's stock out)
            $newStockQuantity = $stock->quantity - $quantityDifference;
    
            if ($newStockQuantity < 0) {
                return redirect()->back()->withErrors(['quantity' => 'Insufficient stock to apply this update.']);
            }
    
            $stock->quantity = $newStockQuantity;
            $stock->save();
        } else {
            // Optionally handle the case where no stock record is found
            return redirect()->route('stockout.view')->with('error', 'Stock record not found!');
        }
    
        // Redirect with success message
        return redirect()->route('stockout.view')->with('success', 'Stock Out updated successfully and stock adjusted!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function delete(Stockout $stockout)
{
    // Add the deleted quantity back to the stock
    $stock = Stock::where('product_id', $stockout->product_id)->first();

    if ($stock) {
        // If stock record exists, increase the quantity by the deleted quantity
        $stock->quantity += $stockout->quantity;
        $stock->save();
    }

    // Delete the StockOut record
    $stockout->delete();

    // Redirect with a success message
    return redirect()->route('stockout.view')->with('success', 'Stock Out entry deleted and stock restored successfully.');
}

}
