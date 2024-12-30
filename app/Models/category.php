<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class category extends Model
{
    protected $table = ("categories");
    protected $primaryKey = 'cat_id';
}
