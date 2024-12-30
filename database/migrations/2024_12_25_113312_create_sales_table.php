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
        Schema::create('sales', function (Blueprint $table) {
     
            $table->bigIncrements('sale_id')->unsigned();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('Completed');
            $table->date('sale_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
