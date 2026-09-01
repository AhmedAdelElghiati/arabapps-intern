<?php

use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
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
