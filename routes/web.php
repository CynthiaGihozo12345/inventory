
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockInController;
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductsController;

Route::get('products/form',[ProductsController::class,'create'])->name('products.create');
Route::post('products/create',[ProductsController::class,'store'])->name('products.store');
Route::get('stock_in/form', [StockInController::class, 'create'])->name('stock_in.create');
Route::post('stock_in/create', [StockInController::class, 'store'])->name('stock_in.store');
Route::get('stock_in/view', [StockInController::class, 'show'])->name('stock_in.view');
