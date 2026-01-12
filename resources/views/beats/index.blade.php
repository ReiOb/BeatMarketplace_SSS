@extends('layouts.app')

@section('content')
<div class="row g-4">
    {{-- Upload form --}}
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Upload new beat</h5>

                <form method="POST"
                      action="{{ route('beats.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Beat file (mp3) File Size: 20MB</label>
                        <input
                            type="file"
                            name="file"
                            accept=".mp3,audio/*"
                            class="form-control @error('file') is-invalid @enderror"
                            required
                        >
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100">
                        Upload beat
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Beats list --}}
    <div class="col-12 col-lg-8">
        <h4 class="mb-3">Latest Beats</h4>

        @forelse ($beats as $beat)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2">
                                {{ $beat->title }}
                                @if($beat->is_sold)
                                    <span class="badge bg-danger ms-2">SOLD</span>
                                @endif
                            </h5>

                            {{-- Producer info --}}
                            <div class="mb-2">
                                <a href="{{ route('profile.show', $beat->user) }}" class="text-decoration-none">
                                    <small class="text-muted">
                                        <strong>{{ $beat->user->name }}</strong>
                                    </small>
                                </a>
                                <small class="text-muted ms-2">
                                    • {{ $beat->created_at->format('M d, Y') }}
                                </small>
                            </div>

                            {{-- BPM & Key --}}
                            @if($beat->bpm || $beat->key)
                                <p class="mb-2 text-muted small">
                                    @if($beat->bpm) <i class="bi bi-music-note"></i> {{ $beat->bpm }} BPM @endif
                                    @if($beat->bpm && $beat->key) • @endif
                                    @if($beat->key) Key: {{ $beat->key }} @endif
                                </p>
                            @endif

                            {{-- Description --}}
                            <p class="card-text small text-muted mb-3">
                                {{ $beat->description }}
                            </p>

                            {{-- Play count --}}
                            <p class="text-xs text-muted mb-3">
                                <i class="bi bi-play-circle"></i> 
                                <span class="play-count-{{ $beat->id }}">{{ $beat->play_count }}</span> 
                                plays
                            </p>
                        </div>

                        {{-- Edit/Delete buttons (only for owner) --}}
                        @if(auth()->check() && auth()->user()->id === $beat->user_id)
                            <div class="ms-3 text-end">
                                <a href="{{ route('beats.edit', $beat) }}"
                                   class="btn btn-sm btn-outline-secondary mb-1">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('beats.destroy', $beat) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this beat?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Wavesurfer waveform --}}
                    <div id="waveform-{{ $beat->id }}" class="mt-3"></div>

                    <button
                        type="button"
                        class="btn btn-outline-primary btn-sm mt-2 play-btn"
                        data-beat-id="{{ $beat->id }}"
                        data-audio-url="{{ Storage::url($beat->file_path) }}"
                    >
                        <i class="bi bi-play-circle"></i> Play / Pause
                    </button>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                <h5 class="alert-heading">No beats yet</h5>
                <p class="mb-0">Be the first to upload a beat! Use the form on the left to get started.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    const wavesurfers = {};

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.play-btn').forEach(btn => {
            const id = btn.dataset.beatId;
            const url = btn.dataset.audioUrl;
            const container = document.getElementById('waveform-' + id);

            if (!container || !url) return;

            const ws = WaveSurfer.create({
                container,
                waveColor: '#4F4A85',
                progressColor: '#383351',
                height: 64,
                url: url,
            });

            wavesurfers[id] = ws;

            btn.addEventListener('click', () => {
                if (ws.isPlaying()) {
                    ws.pause();
                } else {
                    ws.play();
                    incrementPlayCount(id);
                }
            });
        });
    });

    function incrementPlayCount(beatId) {
        // Update frontend display
        const countElement = document.querySelector('.play-count-' + beatId);
        if (countElement) {
            let count = parseInt(countElement.textContent) || 0;
            countElement.textContent = count + 1;
        }

        // Save to database via API
        fetch(`{{ url('/beats') }}/${beatId}/play`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        });
    }
</script>
@endpush