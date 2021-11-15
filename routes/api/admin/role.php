
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

// Route::post('file', [FileController::class, 'upload']);
Route::apiResource('role', RoleController::class);
// Route::get('category/{id}/product', [CategoryController::class,'getCategoryWithProduct'])->name('category.product');