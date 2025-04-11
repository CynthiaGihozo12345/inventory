<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\stock_in;
use App\Models\StockOut;


class products extends Model
{
    use HasFactory;

    protected $fillable = ['product_name'];

    /**
     * Get the stock-in records associated with this stock.
     */
    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    /**
     * Get the stock-out records associated with this stock.
     */
    public function stockOuts()
    {
        return $this->hasMany(stockout::class);
    }

    /**
     * Get the report records associated with this stock.
     */
   
}
