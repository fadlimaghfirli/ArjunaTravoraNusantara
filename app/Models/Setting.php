<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'stat_projects',
        'stat_clients',
        'stat_certification',
        'phone',
        'email',
        'address',
    ];
}
