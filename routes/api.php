<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('/test',[UserController::class,'login']);
Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);
Route::post('/guest',[UserController::class,'guest']);