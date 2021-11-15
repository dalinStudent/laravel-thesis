<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\RoleListResource;
use App\Http\Controllers\Controller;
use App\Models\Roles;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $role = DB::table('roles')->paginate(10);
            return $this->successWithData($role);
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    public function store(Request $req)
    {
        try {
            $role = new Roles($req->all());
            $role->save();
            return $this->success();
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(Request $req, $id)
    {
        $role =  Roles::findOrFail($id);
        //   dd($req->all());
        $role->update($req->all());
        //   dd($department);
        return "Success";
    }

    public function show()
    {

    }

    public function delete($id)
    {
        try {
            Roles::where('id',$id)->delete();
            return $this->success();
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
}
