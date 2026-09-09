<?php

use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\ExamSubmissionController;
use App\Http\Controllers\User\SuccessStoryApiController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('exams')->group(function () {
    Route::get('/', [ExamController::class, 'index']);
    Route::get('/{examId}', [ExamController::class, 'show']);
    Route::post('/{examId}/start', [ExamSubmissionController::class, 'createExamSubmission']);
});

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
