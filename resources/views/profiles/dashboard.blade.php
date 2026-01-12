@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">Your Dashboard</h1>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Beats</h6>
                    <h2 class="display-4">{{ $stats['total_beats'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Plays</h6>
                    <h2 class="display-4">{{ $stats['total_plays'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Sold Beats</h6>
                    <h2 class="display-4">{{ $stats['sold_beats'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Available</h6>
                    <h2 class="display-4">{{ $stats['available_beats'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- users uploaded beats --}}
    <h4 class="mb-3">Your Beats</h4>

    <div class="table-responsive mb-4">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Plays</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beats as $beat)
                    <tr>
                        <td>
                            <strong>{{ $beat->title }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($beat->description, 40) }}</small>
                        </td>
                        <td>{{ $beat->play_count }}</td>
                        <td>
                            @if($beat->is_sold)
                                <span class="badge bg-danger">SOLD</span>
                            @else
                                <span class="badge bg-success">Available</span>
                            @endif
                                            <td>{{ $beat->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('beats.edit', $beat) }}" class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('beats.destroy', $beat) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this beat?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No beats yet. <a href="{{ route('beats.index') }}">Upload your first beat!</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Profile Info --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Profile Information</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Bio:</strong> {{ $user->bio ?? 'Not set' }}</p>
            <p><strong>Website:</strong> {{ $user->website ?? 'Not set' }}</p>

            <a href="{{ route('profile.show', $user) }}" class="btn btn-sm btn-primary">
                View public profile
            </a>
        </div>
    </div>
</div>
@endsection
                
