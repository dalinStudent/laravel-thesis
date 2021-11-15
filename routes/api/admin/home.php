
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::post('file', [FileController::class, 'upload']);

Route::get('dashboard-data', [DashboardController::class,'getalldatadashboard']);