<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Category\Index as CategoryIndex;

Route::middleware('auth')->name('app.')->group(function () {
    // Route from breeze
    Route::view('/', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    // Livewire routes
    Route::name('category.')->group(function () {
        Route::get('category', CategoryIndex::class)
            ->name('index');
    });
});

require __DIR__.'/auth.php';
