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
        'workflow_image',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'tiktok_url',
        'copyright_text',
        'career_url',
        'maps_url',
        'maps_embed',
        'maps_image',
    ];
}
