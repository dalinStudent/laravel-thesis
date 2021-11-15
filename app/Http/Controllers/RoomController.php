<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Room;
use App\Resources\RoomsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        // $room = DB::table('rooms')->paginate(10);
        // $data['rooms'] = RoomsResource::Pagination($room);
        // return $this->successWithData($data);
        $search =  $request->input('keyword');

        $room = DB::table('rooms')->select('rooms.id','rooms.name','rooms.description');
        if($request->input('keyword')){
            $room->where('rooms.name', 'LIKE', '%'.$search.'%');
        }
        $data['rooms'] = RoomsResource::Pagination($room->paginate(6));
        return $this->successWithData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
           
            $room = new Room($request->all());
            $room->save();
            return 'Success';
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $data = Room::where('id', $id)->get();
        dd($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:rooms,name,'.$id.',id',

        ]);
        $room =  Room::findOrFail($id);
        //   dd($request->all());
        $room->update($request->all());
        //   dd($department);
        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::where('id', $id)->delete();
        return $data  = ['status' => 'success'];
    }
}
