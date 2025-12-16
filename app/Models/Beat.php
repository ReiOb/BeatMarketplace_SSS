<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'is_sold',
        'bpm',
        'key',
    ];

    protected $casts = [
        'is_sold' => 'boolean',
    ];
}
