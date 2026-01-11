<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beat extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_path',
        'is_sold',
        'bpm',
        'key',
        'play_count',
    ];

    protected $casts = [
        'is_sold' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
