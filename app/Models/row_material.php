<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class row_material extends Model
{
    protected $table = 'row_materials'; // Ensure this matches your database table name

    protected $primaryKey = 'row_material_id'; 
    protected static function booted()
    {
        static::created(function ($row_material) {
            dailyTask::create([
                'task_type' => 'خرید مواد اولیه',
                'description' => 'خرید ' . $row_material->stock . ' ' . $row_material->unit . ' از ' . $row_material->row_material_name,
               'row_material_id' => $row_material->id,
                
                'quantity' => $row_material->stock,
                'task_date' => now(),
            ]);
        });


        static::updated(function ($row_material) {
            \App\Models\dailyTask::create([
                'task_type' => 'به‌روزرسانی مواد اولیه',
                'description' => 'به‌روزرسانی اطلاعات مواد اولیه ' . $row_material->row_material_name,                
                'quantity' => $row_material->stock,
                'task_date' => now(),
            ]);
        });
        
        static::deleted(function ($row_material) {
            \App\Models\dailyTask::create([
                'task_type' => 'حذف مواد اولیه',
                'description' => 'حذف ' . $row_material->row_material_name,
                'quantity' => $row_material->stock,
                'task_date' => now(),
            ]);
        });
    }
}
