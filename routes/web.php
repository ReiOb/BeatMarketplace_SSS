<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeatController;
use App\Http\Controllers\ProducerProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('beats.index');
});

// Beats CRUD
Route::resource('beats', BeatController::class);

// Producer Profiles
Route::get('/producer/{user}', [ProducerProfileController::class, 'show'])->name('profile.show');

// Dashboard (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProducerProfileController::class, 'dashboard'])->name('dashboard');
});

// Admin Panel (authenticated + admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminController::class);
});

// Static Pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/social', 'pages.social')->name('social');

// Breeze Auth Routes (login, register, password reset, profile edit)
require __DIR__.'/auth.php';

Route::post('/beats/{beat}/play', [BeatController::class, 'play'])->name('beats.play');

Route::middleware('auth')->group(function () {
    Route::resource('beats', BeatController::class);
    Route::post('/beats/{beat}/play', [BeatController::class, 'play'])->name('beats.play');
});

