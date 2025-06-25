<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('app.')->group(function () {
    Route::view('/', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

require __DIR__.'/auth.php';
