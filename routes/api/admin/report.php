
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;


Route::get('studentexport/getalldepartment', [ReportController::class,'getalldepartment']);
Route::get('studentexport', [ReportController::class,'studentexport']);
