<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dailyTask extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'task_type',
        'description',
        'raw_material_id',
        'product_id',
        'quantity',
        'task_date',
    ];

    // تعریف روابط
    public function row_material()
    {
        return $this->belongsTo(row_material::class, 'raw_material_id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function sale()
    {
        return $this->belongsTo(sale::class, 'sale_id');
    }
}
