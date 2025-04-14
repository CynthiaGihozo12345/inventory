<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key for the stock_outs table
            
            // Explicit foreign key definition
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id') // Defining the foreign key
                ->references('id') // The 'id' column of the 'products' table
                ->on('products') // The table being referenced
                ->onDelete('cascade') // If a product is deleted, all related stock_outs will be deleted
                ->onUpdate('cascade'); // If the product id is updated, it will also update here
    
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
