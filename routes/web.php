<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Category\Index as CategoryIndex;
use App\Livewire\Page\Index as PageIndex;
use App\Livewire\Page\Upsert as PageUpsert;

Route::middleware('auth')->name('app.')->group(function () {
    // Route from breeze
    Route::view('/', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    // Livewire routes
    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', CategoryIndex::class)
            ->name('index');
    });

    Route::name('page.')->prefix('page')->group(function () {
        Route::get('/', PageIndex::class)
            ->name('index');
        Route::get('create', PageUpsert::class)
            ->name('create');
        Route::get('edit/{page}', PageUpsert::class)
            ->name('edit');
    });
});

require __DIR__.'/auth.php';
