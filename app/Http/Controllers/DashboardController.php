<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Product;
use App\Models\Students;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DepartmentListResource;
use App\Models\Borrowing;

class DashboardController extends Controller
{
  


  public function getalldatadashboard()
  {
      $data = [];
     $data['number_of_students'] = Students::get()->count();
     $data['number_of_products'] = Product::get()->count();
     $data['number_of_return'] = Borrowing::get()->where('status', "Return")->count();
     $data['number_of_borrowing'] = Borrowing::get()->where('status', "Borrowing")->count();
     
     return $data;
  }

 
}
