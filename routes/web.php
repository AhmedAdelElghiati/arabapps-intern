<?php

use Illuminate\Support\Facades\Route;

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
