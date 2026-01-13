<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beat extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'user_id', 'title', 'description', 'audio_path',  
    'genre', 'bpm', 'price', 'is_sold', 'play_count'
];


    protected $casts = [
        'is_sold' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
        }

        if ($filters['genre'] ?? false) {
            $query->where('genre', $filters['genre']);
        }

        if (isset($filters['availability'])) {
            if ($filters['availability'] === 'available') {
                $query->where('is_sold', false);
            } elseif ($filters['availability'] === 'sold') {
                $query->where('is_sold', true);
            }
        }

        if ($filters['min_bpm'] ?? false) {
            $query->where('bpm', '>=', $filters['min_bpm']);
        }

        if ($filters['max_bpm'] ?? false) {
            $query->where('bpm', '<=', $filters['max_bpm']);
        }

        if ($filters['producer'] ?? false) {
            $query->whereHas('user', function($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['producer'] . '%');
            });
        }

        return $query;
    }
}
