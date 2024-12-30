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
        Schema::create('daily_tasks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('task_type'); // Column for task type
            $table->string('description'); // Column for description
            $table->unsignedBigInteger('row_material_id')->nullable(); // Foreign key for row material
            $table->unsignedBigInteger('product_id')->nullable(); // Foreign key for finished product
            $table->integer('quantity'); // Column for quantity
            $table->date('task_date'); // Column for task date
            $table->timestamps(); // Created at & Updated at

            $table->foreign('row_material_id')->references('row_material_id')->on('row_materials')->onDelete('set null');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_tasks');
    }
};
