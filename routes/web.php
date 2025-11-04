<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;

Route::get('/', [CourseController::class, 'home'])->name('home');      // Home con slider
Route::resource('courses', CourseController::class)->only(['index','store','create','show']); // opcional CRUD básico

