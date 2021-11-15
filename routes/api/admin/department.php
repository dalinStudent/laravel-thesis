
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;

// Route::post('file', [FileController::class, 'upload']);
Route::apiResource('department', DepartmentsController::class);