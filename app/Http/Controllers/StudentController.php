<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Throwable;
use App\Models\Students;
use App\Resources\StudentsResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //     $data = Students::all();
    //  return $data;
    //  $data = Students::when( $request->keyword, function($query, $keyword) {
    //     return $query->where('name', 'LIKE', '%'.$keyword.'%');
    //   })->get();
    // return $data;
    // $student = DB::table('students')->paginate(10);
    // $data['students'] = StudentsResource::Pagination($student);
    // return $this->successWithData($data);

    $search =  $request->input('keyword');
    $name =  $request->input('name');
    $student = DB::table('students')->join('departments', 'students.department_id', '=', 'departments.id')
            ->select('students.id', 'students.name', 'students.shift', 'students.year', 'students.phonenumber1', 'students.phonenumber2','students.DOB', 'students.idcard', 'students.Living_Location','students.gender','departments.name as department_id');
            // dd($student);
        if ($request->input('keyword')) {
            $student->where('students.name', 'LIKE', '%' . $search . '%');
        }
        if ($request->input('name')) {
            $student->where('department_id', 'LIKE', '%' . $name . '%');
        }
        $data['students'] = StudentsResource::Pagination($student->paginate(6));
        return $this->successWithData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validatedData = $req->validate([
            // 'pname' => 'required|max:255|unique:product',
            'department_id' => 'required|exists:departments,id',
            'name.*' => 'distinct'
           
        ]);
        // return $validatedData;
        // dd($validatedData);
        try {
            $students = new Students($req->all());
            // dd($students);
            $students->save();
            return "Success";
          } catch (Throwable $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Students::where('id', $id)->first();
        $data->DOB = Carbon::parse($data->DOB)->format("Y-m-d");
        return $data;
    }

    public function getalldepartment()
    {
        
        $data = Departments::select('id','name')->get();
        
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id){
        $students =  Students::findOrFail($id);
        //   dd($req->all());proo
        $students->update($req->all());
        //   dd($department);
        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $students =  Students::findOrFail($id);
        $isRelation = false;
        // foreach (Students::RELATION_METHOD as $relationMethod) {
        //     $count = $students->$relationMethod()->count();
        //     if($count > 0 ) {
        //         $isRelation = true;
        //     }
        // }
        //   dd($id->all());
        $students->delete();
        //   dd($department);
        return "Success";
    }
    
}
