
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

// Route::post('file', [FileController::class, 'upload']);
Route::apiResource('room', RoomController::class);