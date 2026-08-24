<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {

    Route::post('login', [UserController::class, 'login'])
        ->middleware(['rate.limit']);

    Route::post('guest', [UserController::class, 'guest']);

});
Route::post('register',[UserController::class,'register']);