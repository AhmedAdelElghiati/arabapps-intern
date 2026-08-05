<?php


use App\Http\Controllers\UserControllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/gallery', [GalleryController::class, 'index']);
