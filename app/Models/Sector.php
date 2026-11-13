<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
        'features',
        'image',
        'is_active',
        'sort_order',
    ];
}
