<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
    protected $table = 'products'; // Ensure this matches your database table name

    protected $primaryKey = 'product_id'; 

      protected $fillable = [
        'product_name',
        'price',
        'stock',
    ];
    protected static function booted()
    {
        static::created(function ($product) {
            \App\Models\dailyTask::create([
                'task_type' => 'تولید محصول',
                'description' => 'تولید ' . $product->stock . ' عدد از محصول ' . $product->product_name,
                'quantity' => $product->stock,
                'task_date' => now(),
            ]);
        });

        static::updated(function ($product) {
            \App\Models\dailyTask::create([
                'task_type' => 'به‌روزرسانی محصول',
                'description' => 'به‌روزرسانی اطلاعات محصول ' . $product->product_name,                
                'quantity' => $product->stock,
                'task_date' => now(),
            ]);
        });
        static::deleted(function ($product) {
            \App\Models\dailyTask::create([
                'task_type' => 'حذف محصول',
                'description' => 'حذف محصول ' . $product->product_name,
                'quantity' => $product->stock,
                'task_date' => now(),
            ]);
        });
    }
}
