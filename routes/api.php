<?php
use App\Http\Controllers\User\Api\SuccessStoryApiController;
use Illuminate\Support\Facades\Route;

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
