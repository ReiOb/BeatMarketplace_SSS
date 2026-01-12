<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Beat;
use Illuminate\Support\Str;

class ProducerProfileController extends Controller
{
    public function show(User $user)
    {
        $beats = $user->beats()->latest()->get();
        $totalPlays = $user->beats()->sum('play_count');
        $beatCount = $user->beats()->count();
        $soldCount = $user->beats()->where('is_sold', true)->count();

        return view('profiles.show', compact('user', 'beats', 'totalPlays', 'beatCount', 'soldCount'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        $beats = $user->beats()->latest()->get();

        $stats = [
            'total_beats' => $user->beats()->count(),
            'total_plays' => $user->beats()->sum('play_count'),
            'sold_beats' => $user->beats()->where('is_sold', true)->count(),
            'available_beats' => $user->beats()->where('is_sold', false)->count(),
        ];

        return view('profiles.dashboard', compact('user', 'beats', 'stats'));
    }
}
