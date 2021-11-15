<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('user/getallemployee', [UsersController::class,'getallemployee']);
Route::put('user/UpdateUser/{id}', [UsersController::class, 'UpdateUser']);
Route::post('user/addFromWorker', [UsersController::class, 'addFromWorker']);

Route::get('user', [UsersController::class, 'index']);
// Route::get('user/profile', [UserController::class, 'profile']);
// Route::delete('user/{id}', [UserController::class, 'delete']);

