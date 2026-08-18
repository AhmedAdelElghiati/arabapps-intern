<?php

use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SuccessStoriesController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/students', function () {
    return view('students.index');
})->name('students.index');

Route::get('/students/create', function () {
    return view('students.create');
})->name('students.create');

Route::get('/students/edit/{id}', function () {
    return view('students.edit');
})->name('students.edit');


Route::get('/courses', function () {
    return view('courses.index');
})->name('courses.index');

Route::get('/courses/create', function () {
    return view('courses.create');
})->name('courses.create');

Route::get('/courses/edit/{id}', function () {
    return view('courses.edit');
})->name('courses.edit');

Route::get('/exams', function () {
    return view('exams.index');
})->name('exams.index');

Route::get('/exams/create', function () {
    return view('exams.create');
})->name('exams.create');

Route::get('/exams/edit/{id}', function () {
    return view('exams.edit', ['exam' => (object) []]);
})->name('exams.edit');

//-------------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('success-stories')->name('success-stories.')->group(function () {
        Route::resource('/', SuccessStoriesController::class);
    });

Route::prefix('faqs')->as('faqs.')->group(function () {
    Route::get('/', [FaqsController::class, 'index'])->name('index');
    Route::get('/create', [FaqsController::class, 'create'])->name('create');
    Route::post('/insert', [FaqsController::class, 'store'])->name('store');
    Route::get('/show/{id}', [FaqsController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [FaqsController::class, 'edit'])->name('edit');
    Route::put('/updated/{id}', [FaqsController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FaqsController::class, 'delete'])->name('delete');
});
// Gallery routes
//Route::resource('galleries', GalleryController::class);
Route::prefix('galleries')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
    Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});
