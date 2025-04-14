<?php

namespace App\Http\Controllers;


use App\Models\products;
use App\Models\stock;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  $products= products::all();
        return view('inventory.productview',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
        ]);
    
        // Create product and capture the newly created product
        $product = products::create([
            'product_name' => $validatedData['product_name'],
        ]);
    
        // Create stock entry with product_id and default quantity
        stock::create([
            'product_id' => $product->id,  // Use the actual column name from the migration
            'quantity' => 0,
        ]);
    
        return redirect()->route('products.create')->with('success', 'Product and stock added successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        return view('inventory.productupdate', ['products' => $products]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        // Validate the request
      $data=$request->validate([
            'product_name' => 'required|string|max:255',
        ]);
    
        // Update the product
       $products->update($data);
    
        // Redirect or respond
        return redirect()->route('products.view')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products)
    {
        //
        $products->delete();
        return redirect()->route('products.view')->with('success', 'Product deleted successfully.');
    }
}
