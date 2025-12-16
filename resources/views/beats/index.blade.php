
@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">
    {{-- Upload (Create) --}}
    <form method="POST" action="{{ route('beats.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Title</label>
            <input name="title" class="w-full border px-3 py-2 rounded-md" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded-md"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Beat file (mp3)</label>
            <input type="file" name="file" accept=".mp3,audio/*" required>
        </div>
        <button class="px-4 py-2 rounded-md bg-primary text-primary-foreground text-sm font-medium">
            Upload beat
        </button>
    </form>

    {{-- List (Read) --}}
    <div class="grid gap-4">
        @foreach ($beats as $beat)
            <div class="border rounded-xl p-4 flex flex-col gap-2 bg-card">
                <div class="flex items-center justify-between gap-2">
                    <h2 class="text-base font-medium">
                        {{ $beat->title }}
                        @if($beat->is_sold)
                            <span class="ml-2 text-xs px-2 py-1 rounded-full bg-destructive text-destructive-foreground">
                                SOLD
                            </span>
                        @endif
                    </h2>
                    <div class="flex gap-2 text-xs">
                        <a href="{{ route('beats.edit', $beat) }}" class="underline">Edit</a>
                        <form method="POST" action="{{ route('beats.destroy', $beat) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 underline">Delete</button>
                        </form>
                    </div>
                </div>
                <p class="text-sm text-muted-foreground">{{ $beat->description }}</p>
                <audio controls class="mt-2 w-full">
                    <source src="{{ Storage::url($beat->file_path) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        @endforeach
    </div>
</div>
@endsection