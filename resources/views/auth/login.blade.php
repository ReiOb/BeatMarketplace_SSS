<head>
@extends('layouts.app')

@section('content')
</head>
<div class="relative min-h-screen flex items-center justify-center p-4 overflow-hidden">
    {{-- Video Background --}}
    <video
        autoplay
        loop
        muted
        playsinline
        class="absolute inset-0 w-full h-full object-cover blur-xl scale-110"
    >
        {{-- Replace this src with your actual video URL --}}
        <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4" type="video/mp4">
    </video>

    {{-- Overlay to darken video --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- Content --}}
    <div class="relative z-10">
        {{-- Here goes the LoginPanel markup converted to Blade --}}
        @include('auth.partials.login-panel')
    </div>
</div>
@endsection
