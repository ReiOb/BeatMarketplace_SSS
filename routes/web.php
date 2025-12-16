<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BeatController;

Route::get('/', fn () => redirect()->route('beats.index'));

Route::resource('beats', BeatController::class);

Route::view('/about', 'pages.about')->name('about');
Route::view('/social', 'pages.social')->name('social');