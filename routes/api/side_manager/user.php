<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user', [UserController::class, 'index']);
Route::get('user/profile', [UserController::class, 'profile']);
Route::delete('user/{id}', [UserController::class, 'delete']);
Route::post('user', [UserController::class, 'addFromWorker']);