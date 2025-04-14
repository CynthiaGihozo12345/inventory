<?php

namespace App\Http\Controllers;
// use App\Models\products;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\stock;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function index()
{
    $totalStock = stock::sum('quantity'); // Or however you track stock
    $totalStockIn = StockIn::sum('quantity'); // Assuming `quantity` column
    $totalStockOut = StockOut::sum('quantity');

    return view('welcome', compact('totalStock', 'totalStockIn', 'totalStockOut'));
}
}
