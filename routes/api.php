<?php

use App\Enum\TokenAbility;
use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {

    Route::post('login', [AuthController::class, 'login'])
        ->middleware(['throttle:5,1']);
    //5 request per minute 
    // throttle 

    Route::post('guest', [AuthController::class, 'guest']);

});
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware(['auth:sanctum']);

// Route::post('refresh', [AuthController::class, 'refresh'])
//     // ->middleware([
//     //     'auth:student'
//     //     // ,'ability:refresh_token'
//     // ])
// ;

Route::post('/test', function () {
    return 'HELLO';
});
