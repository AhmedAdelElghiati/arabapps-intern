<?php

use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\ExamSubmissionController;
use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\SuccessStoryApiController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:6,1');

    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
        ->middleware('throttle:6,1');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');

    Route::post('/guest', [AuthController::class, 'guest'])
        ->middleware('throttle:6,1');

    Route::post('/refresh', [AuthController::class, 'refresh'])
        ->middleware(['auth:student', 'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value]);
});


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

Route::middleware('auth:student')->prefix('exams')->group(function () {
    Route::get('/', [ExamController::class, 'index']);
    Route::get('/{examId}', [ExamController::class, 'show']);
    Route::post('/{examId}/start', [ExamSubmissionController::class, 'createExamSubmission']);
});

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
