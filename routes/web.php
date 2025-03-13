<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('LAYOUTS.app');
});
  
// Student Routes
Route::resource('students', StudentController::class);

// Course Routes
Route::resource('courses', CourseController::class);
