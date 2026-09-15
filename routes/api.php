<?php

use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\SuccessStoryApiController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\GalleryController;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\MyCoursesController;
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
    Route::post('/logout',[AuthController::class, 'logout']);
        });
Route::prefix('my-courses')->group(function(){
Route::get('/', [MyCoursesController::class, 'index'])
    ->middleware(['auth:student', 'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value]);
Route::get('/{id}', [MyCoursesController::class, 'show'])
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

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
// api of courses
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/enroll', [CourseController::class, 'enroll'])
        ->middleware(['auth:student', 'student.full']);
    Route::get('/{id}', [CourseController::class, 'show']);
});
