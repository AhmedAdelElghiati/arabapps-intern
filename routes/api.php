<?php


use App\Http\Controllers\User\GalleryController;
use Illuminate\Support\Facades\Route;

Route::prefix('gallery')->group(
    function () {
        Route::get('/', [GalleryController::class, 'index']);
    }
);
