<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockoutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;

Route::get('/adminpage', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('home'); // ✅ This defines 'home'



// ==  prodct



Route::get('/products',[ProductsController::class,'index'])->name('products.view');
Route::get('/products/new',[ProductsController::class,'create'])->name('products.create');
Route::get('/products/{products}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{products}/update', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{products}/delete', [ProductsController::class, 'destroy'])->name('products.delete');
Route::post('products/create',[ProductsController::class,'store'])->name('products.store');





// ====================== stock ========================

Route::get('/stock',[StockController::class,'index'])->name('stock.index');

// ==========   stockin ======
Route::delete('/stockin/{stockin}/delete',[StockInController::class, 'delete'])->name('stockin.delete');


Route::get('/stockin', [StockInController::class, 'show'])->name('stockin.view');
Route::get('stockin/new', [StockInController::class, 'create'])->name('stockin.form');
Route::post('stockin/store', [StockInController::class, 'store'])->name('stockin.store');
Route::get('stockin/{stockin}/edit', [StockInController::class, 'edit'])->name('stockin.edit');
Route::put('/stockin/{stockin}/update', [StockinController::class, 'update'])->name('stockin.update');
//===============stockout ==============

Route::get('/stockout', [StockoutController::class, 'show'])->name('stockout.view');
Route::get('/stockout/new', [StockoutController::class, 'create'])->name('stockout.form');
Route::post('stockout/store', [StockoutController::class, 'store'])->name('stockout.store');
Route::get('stockout/{stockout}/edit', [StockoutController::class, 'edit'])->name('stockout.edit');
Route::put('/stockout/{stockout}/update', [StockoutController::class, 'update'])->name('stockout.update');
Route::delete('/stockout/{stockout}/delete',[StockInController::class, 'delete'])->name('stockout.delete');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');


// user logi

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::get('/adminpage', [AdminController::class, 'index'])->middleware(['auth'])->name('home');
