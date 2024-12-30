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
        Schema::create('row_materials', function (Blueprint $table) {
            $table->bigIncrements('row_material_id')->id()->unsigned();
            $table->string('row_material_name' , 64);
            $table->string('description' , 256)->nullable();
            $table->integer('price');
            $table->string('unit');
            $table->integer('stock');
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')->references('cat_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('row_materials');
    }
};
