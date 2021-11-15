
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeeController;


Route::get('employee/getallrole', [EmployeeController::class,'getallrole']);
Route::apiResource('employee', EmployeeController::class);