<?php
namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeatController extends Controller
{
    public function index()
    {
        $beats = Beat::latest()->get();
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
            'file'        => 'required|mimes:mp3,wav,ogg|max:20480',
        ]);

        $path = $request->file('file')->store('beats', 'public'); // storage/app/public/beats

        Beat::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $path,
        ]);

        return redirect()->route('beats.index');
    }

    public function edit(Beat $beat)
    {
        return view('beats.edit', compact('beat'));
    }

    public function update(Request $request, Beat $beat)
    {
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

        return redirect()->route('beats.index');
    }

    public function destroy(Beat $beat)
    {
        Storage::disk('public')->delete($beat->file_path);
        $beat->delete();

        return redirect()->route('beats.index');
    }
}