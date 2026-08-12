<?php


use App\Http\Controllers\UserControllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::prefix('gallery')->group(
    function () {
        Route::get('/', [GalleryController::class, 'index']);
    }
);
