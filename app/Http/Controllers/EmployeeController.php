<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Employee;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search =  $request->input('keyword');
        $employee =DB::table('employees')->select('employees.id','employees.name','employees.role_id','employees.sex','employees.phone_number','employees.description');
        if ($request->input('keyword')) {
        $employee->where('employees.name', 'LIKE', '%' . $search . '%');
        }
      // $department = DB::table('departments')->paginate(10);
      $data['employees'] = EmployeeResource::Pagination($employee->paginate(6));
      return $this->successWithData($data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validatedData = $req->validate([
            // 'department_id' => 'required|exists:departments,id',
            // 'name.*' => 'distinct'
           
        ]);
       try {
            $employee = new Employee($req->all());
            // dd($employee);
            $employee->save();
            return "Success";
          } catch (Throwable $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::where('id', $id)->first();
        // $data->DOB = Carbon::parse($data->DOB)->format("Y-m-d");
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getallrole()
    {
        $data = Roles::select('id','name')->get();
        return $data;
    }
}
