<?php

use App\Http\Controllers\Admin\Auth\SessionsController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [SessionsController::class, 'create'])->name('admin.login');
        Route::post('/login', [SessionsController::class, 'store'])
        ->middleware('throttle:5,1')->name('admin.login.store');
    });
});

Route::middleware('auth:admin')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::delete('/logout', [SessionsController::class, 'destroy'])->name('admin.logout');

    Route::prefix('galleries')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
        Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });

    Route::prefix('faqs')->as('faqs.')->group(function () {
        Route::get('/', [FaqsController::class, 'index'])->name('index');
        Route::get('/create', [FaqsController::class, 'create'])->name('create');
        Route::post('/insert', [FaqsController::class, 'store'])->name('store');
        Route::get('/show/{id}', [FaqsController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [FaqsController::class, 'edit'])->name('edit');
        Route::put('/updated/{id}', [FaqsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [FaqsController::class, 'delete'])->name('delete');
    });


});



