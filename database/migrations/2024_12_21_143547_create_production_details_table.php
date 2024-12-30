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
        Schema::create('production_details', function (Blueprint $table) {
            $table->bigIncrements('production_detail_id')->id()->unsigned();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('row_material_id')->nullable();
            $table->foreign('row_material_id')->references('row_material_id')->on('row_materials')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date')->nullable();
            $table->integer('quantity_used')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_details');
    }
};
