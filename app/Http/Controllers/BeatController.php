<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeatController extends Controller
{
    public function index()
    {
        $beats = Beat::with('user')->latest()->get();

        return view('beats.index', compact('beats'));
    }

    public function create()
    {
        return view('beats.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|max:20480',
        ]);

        $path = $request->file('file')->store('beats', 'public');

        Beat::create([
            'user_id'     => Auth::id(),
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $path,
            'is_sold'     => false,
            'play_count'  => 0,
        ]);

        return redirect()->route('beats.index')
            ->with('status', 'Beat uploaded!');
    }

    public function edit(Beat $beat)
    {
        $this->authorize('update', $beat);

        return view('beats.edit', compact('beat'));
    }

    public function update(Request $request, Beat $beat)
    {
        $this->authorize('update', $beat);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_sold'     => 'sometimes|boolean',
        ]);

        $beat->update([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'is_sold'     => $request->boolean('is_sold'),
        ]);

        return redirect()->route('beats.index')
            ->with('status', 'Beat updated!');
    }

    public function destroy(Beat $beat)
    {
        $this->authorize('delete', $beat);

        Storage::disk('public')->delete($beat->file_path);
        $beat->delete();

        return redirect()->route('beats.index')
            ->with('status', 'Beat deleted!');
    }
}
