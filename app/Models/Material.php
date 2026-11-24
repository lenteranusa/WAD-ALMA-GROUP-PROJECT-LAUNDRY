<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'brand', 'category', 'supplier', 'unit', 'stock', 'status',
    ];
}