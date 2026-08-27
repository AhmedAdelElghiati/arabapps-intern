<?php

use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('login', [AuthController::class, 'login'])
        ->middleware(['throttle:5,1']);
    //5 request per minute 
    // throttle 

    Route::post('guest', [AuthController::class, 'guest']);

});
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware(['auth:student','ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value]);

// Route::post('refresh', [AuthController::class, 'refresh'])
//     // ->middleware([
//     //     'auth:student'
//     //     // ,'ability:refresh_token' 'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value
//     // ])
// ;

Route::post('/test', function () {
    return 'HELLO';
});
