
<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::post('file', [FileController::class, 'upload']);
Route::apiResource('category', CategoryController::class);
Route::get('category/{id}/product', [CategoryController::class,'getCategoryWithProduct'])->name('category.product');