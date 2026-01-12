@extends('layouts.app')

@section('content')
<div class="row">
    {{-- Producer Info --}}
    <div class="col-12 col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h3 class="card-title">{{ $user->name }}</h3>

                @if($user->bio)
                    <p class="card-text text-muted small">{{ $user->bio }}</p>
                @endif

                @if($user->website)
                    <a href="{{ $user->website }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                        Visit website
                    </a>
                @endif

                <div class="mt-3">
                    <div class="mb-2">
                        <strong class="d-block">{{ $beatCount }}</strong>
                        <small class="text-muted">Beats</small>
                    </div>
                    <div class="mb-2">
                        <strong class="d-block">{{ $totalPlays }}</strong>
                        <small class="text-muted">Total plays</small>
                    </div>
                    <div>
                        <strong class="d-block">{{ $soldCount }}</strong>
                        <small class="text-muted">Sold</small>
                    </div>
                </div>

                @auth
                    @if(auth()->id() === $user->id)
                        <hr>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">
                            Go to dashboard
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- Producer's Beats --}}
    <div class="col-12 col-md-8">
        <h4 class="mb-3">Beats by {{ $user->name }}</h4>

        @forelse($beats as $beat)
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

                            <p class="card-text small text-muted mb-2">
                                {{ $beat->description }}
                            </p>

                            <p class="text-xs text-muted">
                                <i class="bi bi-play-circle"></i> {{ $beat->play_count }} plays
                            </p>
                        </div>
                    </div>

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
            <p class="text-muted">No beats from this producer yet.</p>
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
