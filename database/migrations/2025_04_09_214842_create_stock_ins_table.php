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
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key
            $table->unsignedBigInteger('product_id'); // Explicitly setting the type of the foreign key column
            $table->foreign('product_id')  // Defining the foreign key constraint
                  ->references('id')     // Referencing the 'id' column of the 'products' table
                  ->on('products')       // Ensuring the foreign key points to the 'products' table
                  ->onDelete('cascade')  // Deletes related stock_ins if a product is deleted
                  ->onUpdate('cascade'); // Updates related stock_ins if the product is updated
            $table->integer('quantity');    // Stores the quantity of stock
            $table->decimal('price', 8, 2); // Stores the price of the stock item
            $table->timestamps();           // Creates the 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ins'); // Drops the 'stock_ins' table if it exists
    }
};
