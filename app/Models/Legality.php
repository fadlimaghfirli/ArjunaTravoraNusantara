<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'document_number',
        'description',
        'image',
        'is_active',
        'sort_order',
    ];

    public function isPdf(): bool
    {
        return strtolower(pathinfo((string) $this->image, PATHINFO_EXTENSION)) === 'pdf';
    }
}
