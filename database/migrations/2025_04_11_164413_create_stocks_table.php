<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            // Foreign key to products table
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
?>