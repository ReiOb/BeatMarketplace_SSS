<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeatController extends Controller
{
    public function index(Request $request)
    {
        $query = Beat::with('user')->filter($request->only([
            'search', 'genre', 'availability', 
            'min_bpm', 'max_bpm', 'producer'
        ]));

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        switch ($sortBy) {
            case 'title':
                $query->orderBy('title', $sortOrder);
                break;
            case 'play_count':
                $query->orderBy('play_count', $sortOrder);
                break;
            case 'bpm':
                $query->orderBy('bpm', $sortOrder);
                break;
            case 'created_at':
            default:
                $query->orderBy('created_at', $sortOrder);
                break;
        }

        $beats = $query->paginate(12)->withQueryString();

        return view('beats.index', compact('beats'));
    }

    public function create()
    {
        return view('beats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:50',
            'bpm' => 'nullable|integer|min:60|max:200',
            'file' => 'required|file|mimes:mp3,wav|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('beats', 'public');
            
            Beat::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'genre' => $validated['genre'] ?? null,
                'bpm' => $validated['bpm'] ?? null,
                'audio_path' => $path,
            ]);

            return redirect()->route('beats.index')
                ->with('success', 'Beat uploaded successfully!');
        }

        return back()->withErrors(['file' => 'File upload failed.']);
    }

    public function show(Beat $beat)
    {
        return view('beats.show', compact('beat'));
    }

    public function edit(Beat $beat)
    {
        // Check if user owns this beat
        if (auth()->user()->id !== $beat->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('beats.edit', compact('beat'));
    }

    public function update(Request $request, Beat $beat)
    {
        // Check if user owns this beat
        if (auth()->user()->id !== $beat->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:50',
            'bpm' => 'nullable|integer|min:60|max:200',
            'is_sold' => 'nullable|boolean',
        ]);

        $beat->update($validated);

        return redirect()->route('beats.index')
            ->with('success', 'Beat updated successfully!');
    }

    public function destroy(Beat $beat)
    {
        // Check if user owns this beat
        if (auth()->user()->id !== $beat->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the audio file from storage
        if ($beat->audio_path && Storage::disk('public')->exists($beat->audio_path)) {
            Storage::disk('public')->delete($beat->audio_path);
        }

        // Delete the beat record
        $beat->delete();

        return redirect()->route('beats.index')
            ->with('success', 'Beat deleted successfully!');
    }

    public function play(Beat $beat)
    {
        $beat->increment('play_count');
        return response()->json(['play_count' => $beat->play_count]);
    }
}
