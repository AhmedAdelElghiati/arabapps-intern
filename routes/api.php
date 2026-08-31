<?php
use App\Http\Controllers\User\SuccessStoryApiController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;
use Illuminate\Support\Facades\Route;

Route::middleware('api-lang')->prefix('faqs')->as('faqs.')->group(function () {
    Route::get('/', [FaqsController::class, 'index']);
    Route::get('/{id}',  [FaqsController::class, 'show']);
});



Route::prefix('gallery')->group(
    function () {
        Route::get('/', [GalleryController::class, 'index']);
        Route::get('/{gallery}', [GalleryController::class, 'show']);
    }
);

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
