
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::post('file', [FileController::class, 'upload']);
Route::get('product/getallcategoryname', [ProductController::class,'getallcategory']);
Route::get('get-product-available', [ProductController::class,'getProductInStock']);
Route::apiResource('product', ProductController::class);
Route::get('product/{id}/category', [ProductController::class,'getCategoryByProduct'])->name('product.category');