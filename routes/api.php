<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( [], function () {

    // Route::post('register', [AuthController::class,'register']);

    // Route::post('department', [DepartmentsController::class,'index']);
    Route::post('login', [AuthController::class,'login']);
    // Route::get('file-web/{id}', [FileController::class, 'webShow'])->name('file.show.web');

    Route::group([
        // 'middleware' => 'auth:api',//
    ], function() {
        //common
        Route::post('logout', [AuthController::class,'logout']);
        // Route::post('department/create', [DepartmentsController::class,'create']);
        // Route::put('department/edit/{id}', [DepartmentsController::class,'update']);
        // Route::delete('department/delete/{id}', [DepartmentsController::class,'delete']);


        // Route::get('category', [CategoryController::class,'index']);

    //     Route::post('file', [FileController::class,'upload']);
    //     Route::delete('file/{id}', [FileController::class,'delete']);

        Route::group([
                'prefix' => 'admin'
            ], function() {
                foreach (glob(dirname(__FILE__) . "/api/admin/*.php") as $filename) {
                    include $filename;
                }
            });

        // Route::group([
        //         'prefix' => 'assistant'
        //     ], function() {
        //         foreach (glob(dirname(__FILE__) . "/api/side_manager/*.php") as $filename) {
        //             include $filename;
        //         }
        //     });

        Route::group([
                'prefix' => 'assistant'
            ], function() {
                foreach (glob(dirname(__FILE__) . "/api/assistant/*.php") as $filename) {
                    include $filename;
                }
            });
    });
});