<?php

use App\Livewire\Category\Index as CategoryIndex;
use App\Livewire\Media;
use App\Livewire\Page\Index as PageIndex;
use App\Livewire\Page\Upsert as PageUpsert;
use App\Livewire\Post\Index as PostIndex;
use App\Livewire\Post\Upsert as PostUpsert;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

    Route::name('post.')->prefix('post')->group(function () {
        Route::get('/', PostIndex::class)
            ->name('index');
        Route::get('create', PostUpsert::class)
            ->name('create');
        Route::get('edit/{post}', PostUpsert::class)
            ->name('edit');
    });

    Route::get('/media', Media::class)
        ->name('media');
    Route::group(['prefix' => 'media-gallery'], function () {
        Lfm::routes();
    });
});

require __DIR__.'/auth.php';
