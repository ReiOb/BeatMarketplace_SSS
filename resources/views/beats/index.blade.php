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
                        <label class="form-label">Genre</label>
                        <select name="genre" class="form-select @error('genre') is-invalid @enderror">
                            <option value="">Select Genre (Optional)</option>
                            <option value="Hip Hop" {{ old('genre') == 'Hip Hop' ? 'selected' : '' }}>Hip Hop</option>
                            <option value="Trap" {{ old('genre') == 'Trap' ? 'selected' : '' }}>Trap</option>
                            <option value="R&B" {{ old('genre') == 'R&B' ? 'selected' : '' }}>R&B</option>
                            <option value="Pop" {{ old('genre') == 'Pop' ? 'selected' : '' }}>Pop</option>
                            <option value="Electronic" {{ old('genre') == 'Electronic' ? 'selected' : '' }}>Electronic</option>
                            <option value="Rock" {{ old('genre') == 'Rock' ? 'selected' : '' }}>Rock</option>
                            <option value="Jazz" {{ old('genre') == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                            <option value="Lo-fi" {{ old('genre') == 'Lo-fi' ? 'selected' : '' }}>Lo-fi</option>
                            <option value="Other" {{ old('genre') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">BPM (Tempo)</label>
                        <input
                            type="number"
                            name="bpm"
                            class="form-control @error('bpm') is-invalid @enderror"
                            value="{{ old('bpm') }}"
                            min="60"
                            max="200"
                            placeholder="e.g., 120"
                        >
                        @error('bpm')
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

    {{-- Beats list with filters --}}
    <div class="col-12 col-lg-8">
        
        {{-- FILTER & SORT SECTION --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('beats.index') }}">
                    <div class="row g-2">
                        
                        <div class="col-md-4">
                            <input type="text" 
                                   name="search" 
                                   class="form-control form-control-sm" 
                                   placeholder="Search beats..." 
                                   value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <select name="genre" class="form-select form-select-sm">
                                <option value="">All Genres</option>
                                @foreach(['Hip Hop', 'Trap', 'R&B', 'Pop', 'Electronic', 'Rock', 'Jazz', 'Lo-fi', 'Other'] as $genre)
                                    <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                        {{ $genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="sort_by" class="form-select form-select-sm">
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Newest</option>
                                <option value="play_count" {{ request('sort_by') == 'play_count' ? 'selected' : '' }}>Most Played</option>
                                <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="bpm" {{ request('sort_by') == 'bpm' ? 'selected' : '' }}>BPM</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>

                    </div>

                    <div class="mt-2">
                        <a data-bs-toggle="collapse" href="#advancedFilters" class="text-decoration-none small">
                            <i class="bi bi-sliders"></i> More Filters
                        </a>
                    </div>

                    <div class="collapse mt-2" id="advancedFilters">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label class="form-label small">Min BPM</label>
                                <input type="number" name="min_bpm" class="form-control form-control-sm" 
                                       value="{{ request('min_bpm') }}" placeholder="e.g., 80">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Max BPM</label>
                                <input type="number" name="max_bpm" class="form-control form-control-sm" 
                                       value="{{ request('max_bpm') }}" placeholder="e.g., 140">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Producer</label>
                                <input type="text" name="producer" class="form-control form-control-sm" 
                                       value="{{ request('producer') }}" placeholder="Search producer...">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Availability</label>
                                <select name="availability" class="form-select form-select-sm">
                                    <option value="">All</option>
                                    <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ request('availability') == 'sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if(request()->hasAny(['search', 'genre', 'sort_by', 'min_bpm', 'max_bpm', 'producer', 'availability']))
                    <div class="mt-2">
                        <a href="{{ route('beats.index') }}" class="btn btn-link btn-sm text-decoration-none">
                            <i class="bi bi-x-circle"></i> Clear Filters
                        </a>
                    </div>
                    @endif

                </form>
            </div>
        </div>

        @if($beats->total() > 0)
        <div class="mb-3">
            <small class="text-muted">Showing {{ $beats->count() }} of {{ $beats->total() }} beats</small>
        </div>
        @endif

        <h4 class="mb-3">
            @if(request('search'))
                Search Results for "{{ request('search') }}"
            @else
                Latest Beats
            @endif
        </h4>

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

                            <div class="mb-2">
                                <small class="text-muted">
                                    <strong>{{ $beat->user->name }}</strong>
                                </small>
                                <small class="text-muted ms-2">
                                    • {{ $beat->created_at->format('M d, Y') }}
                                </small>
                            </div>

                            <div class="mb-2">
                                @if($beat->genre)
                                    <span class="badge bg-secondary">{{ $beat->genre }}</span>
                                @endif
                                @if($beat->bpm)
                                    <span class="badge bg-info text-dark">{{ $beat->bpm }} BPM</span>
                                @endif
                            </div>

                            @if($beat->description)
                            <p class="card-text small text-muted mb-3">
                                {{ $beat->description }}
                            </p>
                            @endif

                            <p class="text-xs text-muted mb-3">
                                <i class="bi bi-play-circle"></i> 
                                <span class="play-count-{{ $beat->id }}">{{ $beat->play_count }}</span> 
                                plays
                            </p>
                        </div>

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
                    <div id="waveform-{{ $beat->id }}" class="mt-3" style="min-height: 64px;"></div>

                    <button
                        type="button"
                        class="btn btn-outline-primary btn-sm mt-2 play-btn"
                        data-beat-id="{{ $beat->id }}"
                        data-audio-url="{{ asset('storage/' . $beat->audio_path) }}"
                    >
                        <i class="bi bi-play-circle"></i> Play / Pause
                    </button>
                </div>
            </div>
         @empty
            <div class="alert alert-info">
                <h5 class="alert-heading">
                    @if(request()->hasAny(['search', 'genre', 'min_bpm', 'max_bpm']))
                        No beats found
                    @else
                        No beats yet
                    @endif
                </h5>
                <p class="mb-0">
                    @if(request()->hasAny(['search', 'genre', 'min_bpm', 'max_bpm']))
                        Try adjusting your filters or search terms.
                    @else
                        Be the first to upload a beat! Use the form on the left to get started.
                    @endif
                </p>
            </div>
        @endforelse

        @if($beats->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $beats->links() }}
        </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    const wavesurfers = {};
    let playedBeats = new Set(); // Track which beats have been played

    document.addEventListener('DOMContentLoaded', () => {
        console.log('Initializing Wavesurfer...');
        
        // Check if WaveSurfer is loaded
        if (typeof WaveSurfer === 'undefined') {
            console.error('WaveSurfer is not loaded!');
            return;
        }

        document.querySelectorAll('.play-btn').forEach(btn => {
            const id = btn.dataset.beatId;
            const url = btn.dataset.audioUrl;
            const container = document.getElementById('waveform-' + id);

            console.log('Setting up beat:', id, 'URL:', url);

            if (!container || !url) {
                console.error('Missing container or URL for beat:', id);
                return;
            }

            // Create WaveSurfer instance
            try {
                const ws = WaveSurfer.create({
                    container: container,
                    waveColor: '#4F4A85',
                    progressColor: '#383351',
                    cursorColor: '#383351',
                    barWidth: 2,
                    barRadius: 3,
                    height: 64,
                    normalize: true,
                    url: url,
                });

                wavesurfers[id] = ws;

                // Handle loading
                ws.on('loading', (percent) => {
                    console.log('Loading beat ' + id + ':', percent + '%');
                });

                // Handle ready
                ws.on('ready', () => {
                    console.log('Beat ' + id + ' is ready to play');
                });

                // Handle errors
                ws.on('error', (error) => {
                    console.error('WaveSurfer error for beat ' + id + ':', error);
                    alert('Error loading audio file. Please check the file path.');
                });

                // Play button click handler
                btn.addEventListener('click', () => {
                    if (ws.isPlaying()) {
                        ws.pause();
                        btn.innerHTML = '<i class="bi bi-play-circle"></i> Play / Pause';
                    } else {
                        // Pause all other players
                        Object.keys(wavesurfers).forEach(key => {
                            if (key !== id && wavesurfers[key].isPlaying()) {
                                wavesurfers[key].pause();
                            }
                        });

                        ws.play();
                        btn.innerHTML = '<i class="bi bi-pause-circle"></i> Play / Pause';
                        
                        // Increment play count only once per session
                        if (!playedBeats.has(id)) {
                            incrementPlayCount(id);
                            playedBeats.add(id);
                        }
                    }
                });

                // Update button when playback finishes
                ws.on('finish', () => {
                    btn.innerHTML = '<i class="bi bi-play-circle"></i> Play / Pause';
                });

            } catch (error) {
                console.error('Error creating WaveSurfer for beat ' + id + ':', error);
            }
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
        fetch(`/beats/${beatId}/play`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Play count updated:', data);
        })
        .catch(error => {
            console.error('Error updating play count:', error);
        });
    }
</script>
@endpush
