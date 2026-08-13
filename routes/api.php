<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;

Route::controller(FaqsController::class)->prefix('faqs')->as('faqs.')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});



Route::prefix('gallery')->group(
    function () {
        Route::get('/', [GalleryController::class, 'index']);
        Route::get('/{gallery}', [GalleryController::class, 'show']);
    }
);
