<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersListResource;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        try {
            $query = new User();
            $user = auth()->user();
            // dd($user);
            // if ($user->role == 'assistant') {
            //     $query = $query->where('creator_id', $user->id);
            // }
            $data['users'] = UsersListResource::Pagination($query->where('role', $req->role)->paginate());
            return $this->successWithData($data);
        } 
        catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
    public function addFromWorker(Request $req)
    {
        DB::beginTransaction();
        try {
            $attribute = $req->all();
            // dd($attribute);
            $attribute['password'] = Hash::make($attribute['password']);
            $user = new User($attribute);
            // $user->creator_id = auth()->user()->employee_id;
            $user->save();
            Employee::where('id', $attribute['employee_id'])->update(['type' => 'user']);
            DB::commit();
            return $this->success();
        } catch (Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
    public function UpdateUser(Request $req,$id)
    {
        DB::beginTransaction();
        try {
            $user =  User::findOrFail($id);
        
            $attribute = $req->all();
            // dd($attribute);
            $attribute['password'] = Hash::make($attribute['password']);
            dd($attribute['password']);
            $user = new User($attribute);
            // dd($user);
            // $user->creator_id = auth()->user()->employee_id;
            $user->update($req->all());
            // $user->save();
            // Employee::where('id', $attribute['employee_id'])->update(['type' => 'user']);
            DB::commit();
            return $this->success();
        } catch (Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function getallemployee()
    {
        
        $data = Employee::select('id','name')->get();
        
        return $data;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
