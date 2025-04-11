<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;

class StockOut extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'quantity_out', 'price'];

    /**
     * Get the stock record associated with this stock-out.
     */
    public function products()
    {
        return $this->belongsTo(products::class);
    }
}
