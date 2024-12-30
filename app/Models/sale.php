<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $table = 'sales'; // Ensure this matches your table name
    protected $primaryKey = 'sale_id'; // This should match the primary key
    protected $fillable = [
        'product_id',
        'customer_id',
        'quantity',
        'unit_price',
        'total_price',
        'sale_date',
        'status',
    ];
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
    protected static function booted()
    {
        static::created(function ($sale) {
            $product = $sale->product; // Fetch the related product
    
            // Use the product name if it exists, otherwise fallback to 'نامشخص'
            $productName = $product ? $product->product_name : 'نامشخص';
    
            \App\Models\DailyTask::create([
                'task_type' => 'فروش محصول',
                'description' => 'فروش ' . $sale->quantity . ' عدد از محصول ' . $productName,
                'product_id' => $sale->product_id,
                'quantity' => $sale->quantity,
                'task_date' => now(),
            ]);
        });
    }
    
    
}
