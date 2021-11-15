
<?php

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::post('file', [FileController::class, 'upload']);
Route::get('borrowingproduct/getallproduct', [BorrowingController::class,'getallproduct']);
Route::put('borrowingproduct/returnBorrowing/{id}', [BorrowingController::class,'returnBorrowing']);
Route::put('borrowingproduct/cancelBorrowing/{id}', [BorrowingController::class,'cancelBorrowing']);
Route::get('borrowingproduct/getallstudent', [BorrowingController::class,'getallstudent']);
Route::get('borrowingproduct/getallroom', [BorrowingController::class,'getallroom']);
Route::put('borrowingproduct/update-status/{id}', [BorrowingController::class,'updateStatus'])->name('borrowing.update-status');
Route::apiResource('borrowingproduct', BorrowingController::class);


