@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h1 class="h2 mb-3">About Beat Marketplace</h1>

                <p class="lead text-muted">
                    Beat Marketplace is a modern platform where music producers and beat makers
                    can share, discover, and sell their original beats and melodies.
                </p>

                <hr>

                <h5 class="mt-4 mb-3">Our Mission</h5>
                <p>
                    We believe in connecting talented producers with artists and musicians worldwide.
                    Our platform makes it simple to upload, showcase, and monetize your beats with
                    a clean, intuitive interface powered by modern web technology.
                </p>

                <h5 class="mt-4 mb-3">Features</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Audio Waveform Visualization</strong> - See your beat's waveform with Wavesurfer.js
                    </li>
                    <li class="list-group-item">
                        <strong>Easy Upload</strong> - Upload mp3, wav, or ogg files with metadata
                    </li>
                    <li class="list-group-item">
                        <strong>Beat Management</strong> - Edit titles, descriptions, and mark beats as sold
                    </li>
                    <li class="list-group-item">
                        <strong>Responsive Design</strong> - Works on desktop, tablet, and mobile
                    </li>
                </ul>

                <h5 class="mt-4 mb-3">Technology Stack</h5>
                <p>
                    Built with <strong>Laravel</strong> for the backend, <strong>Bootstrap 5</strong> for styling,
                    and <strong>Wavesurfer.js</strong> for interactive audio visualization.
                </p>

                <h5 class="mt-4 mb-3">Get Started</h5>
                <p>
                    Ready to share your beats? Head to the
                    <a href="{{ route('beats.index') }}">Beats page</a> and upload your first track!
                </p>
            </div>
        </div>
    </div>
</div>
@endsection