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
                        <label class="form-label">Beat file (mp3)</label>
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
        @forelse ($beats as $beat)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title mb-1">
                                {{ $beat->title }}
                                @if($beat->is_sold)
                                    <span class="badge bg-danger ms-2">SOLD</span>
                                @endif
                            </h5>

                            @if($beat->bpm || $beat->key)
                                <p class="mb-1 text-muted small">
                                    @if($beat->bpm) {{ $beat->bpm }} BPM @endif
                                    @if($beat->bpm && $beat->key) • @endif
                                    @if($beat->key) Key: {{ $beat->key }} @endif
                                </p>
                            @endif

                            <p class="card-text small text-muted mb-2">
                                {{ $beat->description }}
                            </p>
                        </div>

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
                                        class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Wavesurfer waveform --}}
                    <div id="waveform-{{ $beat->id }}" class="mt-3"></div>

                    <button
                        type="button"
                        class="btn btn-outline-primary btn-sm mt-2 play-btn"
                        data-beat-id="{{ $beat->id }}"
                        data-audio-url="{{ Storage::url($beat->file_path) }}"
                    >
                        Play / Pause
                    </button>
                </div>
            </div>
        @empty
            <p class="text-muted">No beats yet. Upload your first beat!</p>
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
                ws.isPlaying() ? ws.pause() : ws.play();
            });
        });
    });
</script>
@endpush
