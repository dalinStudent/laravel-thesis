<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\DepartmentsListResource;




class DepartmentsController extends Controller
{
  // public function indexadmin(){
  //     $data['department'] = departmentListResource::collection(Departments::get());
  //     return $this->successWithData($data);
  // }



  public function index(Request $request)
  {
    //  $data = Departments::when( $request->keyword, function($query, $keyword) {
    //     return $query->where('name', 'LIKE', '%'.$keyword.'%');
    //   })->get();
    //  return $data;
    $search =  $request->input('keyword');
    $department =DB::table('departments')->select('departments.id','departments.name','departments.description');
     if ($request->input('keyword')) {
      $department->where('departments.name', 'LIKE', '%' . $search . '%');
      }
      // $department = DB::table('departments')->paginate(10);
      $data['departments'] = DepartmentsListResource::Pagination($department->paginate(6));
      return $this->successWithData($data);
  }

  public function store(Request $req)
  {
    # code..

    $validatedData = $req->validate([
      'name' => 'required|unique:departments|max:255',
      
    ]);

    try {
      $department = new Departments($req->all());
      $department->save();
    } catch (Throwable $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    }
    // dd($req->all());
  }

  // }
  public function update(Request $req, $id)
  {
    # code..
    // dd($id);
    $department =  Departments::findOrFail($id);
    //   dd($req->all());
    $department->update($req->all());
    //   dd($department);
    return "Success";
    //  dd(Departments::findOrFail($id));
    //         try {
    //             $department = new Departments($req->all());
    //             $department->save();
    //     } catch (Throwable $e) {
    //          DB::rollBack();
    //             return $this->error($e->getMessage());
    // }
    // dd($req->all());
  }
  public function destroy($id)
  {
    # code..
    // dd($id);
    $department =  Departments::findOrFail($id);
    //   dd($req->all());
    $department->delete();
    //   dd($department);
    return "Success";
    //  dd(Departments::findOrFail($id));
    //         try {
    //             $department = new Departments($req->all());
    //             $department->save();
    //     } catch (Throwable $e) {
    //          DB::rollBack();
    //             return $this->error($e->getMessage());
    // }
    // dd($req->all());
  }
  public function show($id)
  {
    # code..
    // dd($id);
    $department =  Departments::find($id);
    
    //   dd($req->all());
    //   dd($department);
    return $department;
    //  dd(Departments::findOrFail($id));
    //         try {
    //             $department = new Departments($req->all());
    //             $department->save();
    //     } catch (Throwable $e) {
    //          DB::rollBack();
    //             return $this->error($e->getMessage());
    // }
    // dd($req->all());
  }
}
