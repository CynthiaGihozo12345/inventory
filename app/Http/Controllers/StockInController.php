<?php

namespace App\Http\Controllers;

use App\Models\products; // Corrected model name: Product (singular, StudlyCase)
use App\Models\stockin;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function create()
    {
        // Fetch all products
        $products = products::all(); 
        return view('inventory.stock_in', compact('products')); // Pass products to the view
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
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

        // Redirect with a success message
        return redirect()->route('stock_in.create')->with('success', 'Stock In created successfully!');
    }
    public function show(){
        $products=stockin::all();
        return view('inventory.stockinselect',compact('products'));
    }
}
