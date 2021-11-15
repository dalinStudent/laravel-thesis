<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\StudentController;

// Route::post('file', [FileController::class, 'upload']);
Route::get('student/getalldepartment', [StudentController::class,'getalldepartment']);
Route::apiResource('student', StudentController::class);



