<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Product;
use App\Models\Borrowing;
use App\Models\Room;
use App\Models\Students;
use App\Resources\BorrowingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Borders;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Borrowing::all();
        // $data = Borrowing::when( $request->keyword, function($query, $keyword) {
        //     return $query->where('name', 'LIKE', '%'.$keyword.'%');
        //   })->get();
        // return $data;
        // $data['product']
        // return $data;
        $search =  $request->input('keyword');
        // $borrowing = DB::table('borrowing')->paginate(1);
        // $data['borrowing'] = BorrowingsResource::Pagination($borrowing);
        // return $this->successWithData($data);

        // 'id' => $this->id,
        // 'user_id' => $this->user_id,
        // 'qty' => $this->qty,
        // 'start_datetime' => $this->start_datetime,
        // 'end_datetime' => $this->end_datetime,
        // 'status' => $this->status,
        // 'room_id' => $this->room_id,
        // 'product_id' => $this->product_id

        $borrowing = DB::table('borrowing')->join('rooms', 'borrowing.room_id', '=', 'rooms.id')
            ->join('students', 'borrowing.user_id', '=', 'students.id')
            ->join('products', 'borrowing.product_id', '=', 'products.id')
            ->select('borrowing.id', 'students.name as user_id', 'borrowing.qty', 'borrowing.return_qty' , 'borrowing.start_datetime', 'borrowing.end_datetime', 'borrowing.status', 'rooms.name as room_id', 'products.name as product_id');
        if ($request->input('keyword')) {
            $borrowing->where('students.name', 'LIKE', '%' . $search . '%');
        }
        $data['products'] = BorrowingsResource::Pagination($borrowing->paginate(6));
        return $this->successWithData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // $validatedData = $req->validate([
        //     // 'pname' => 'required|max:255|unique:product',
        //     'roomID' => 'required|exists:rooms,id',
        //     // 'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id'
        // ]);
        $product = Product::findOrFail($req->product_id);
        $validatedData = $req->validate([
            'qty' => 'required|min:,' . $product->qty,
        ]);
    
        try {
            $borrowing = new Borrowing($req->all());
            $borrowing->save();
            $product->qty  = $product->qty - $req->qty;
            $product->save();
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
        $data = Borrowing::where('id', $id)->first();
        // $data->DOB = Carbon::parse($data->DOB)->format("Y-m-d");
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $borrowing =  Borrowing::findOrFail($id);
        //   dd($req->all());
        $borrowing->update($req->all());
        //   dd($department);
        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $borrowing =  Borrowing::findOrFail($id);
        //   dd($req->all());
        $borrowingqty = $borrowing->qty;
        $productId = $borrowing->product_id;
        $delete = $borrowing->delete();
        $product = Product::findOrFail($productId);
        if ($delete) {
            $product->update(["qty" => $product->qty + $borrowingqty]);
        }
        // dd($product);

        //   dd($department);
        return "Success";
    }

    public function updateStatus(Request $req, $id)
    {

        $validatedData = $req->validate([
            // 'status' => 'required|in:return,late,borrowing',
        ]);

        $borrowing =  Borrowing::findOrFail($id);
     
        // dd($borrowing);
        $product = Product::findOrFail($borrowing->product_id);
        $borrowingQty = $borrowing->qty;
        $borrowingReturnQty = $borrowing->return_qty;
        $productQty = $product->qty;
        $borrowing->update($req->all());
        // $update = $borrowing->update(["status" => $req->status]);

          
        if ($req->qty >  $borrowingQty ) {
            $qtyupdate = $req->qty - $borrowingQty ;
            // dd($qtyupdate);
            $product->update(['qty' => $productQty - $qtyupdate]);
            // $product->update(['qty' => $productQty + $borrowingQty]);
            // $borrowing->update(['return_qty' => $borrowingQty, "qty" => 0]);
        }else  if ($req->qty <  $borrowingQty ) {
            $qtyupdate =   $borrowingQty - $req->qty;
            // dd($qtyupdate);
            // dd($req->qty);
            // dd($qtyupdate);
            $product->update(['qty' => $productQty + $qtyupdate]);
        }
        
        // if ($req->status == 'return' && $borrowingReturnQty == 0) {
        //     $product->update(['qty' => $productQty + $borrowingQty]);
        //     $borrowing->update(['return_qty' => $borrowingQty, "qty" => 0]);
        // };

        if ( $req->status == 'Return' || $req->status == 'Cancel') {
            // dd($req->status);
            $borrowing->update(['return_qty' => $borrowingQty]);
            $product->update(['qty' => $productQty + $borrowingQty]);
        }
        else
        {
            if ($req->qty >  $borrowingQty ) {
                $qtyupdate = $req->qty - $borrowingQty ;
                // dd($qtyupdate);
                $product->update(['qty' => $productQty - $qtyupdate]);
                // $product->update(['qty' => $productQty + $borrowingQty]);
                // $borrowing->update(['return_qty' => $borrowingQty, "qty" => 0]);
            }else  if ($req->qty <  $borrowingQty ) {
                $qtyupdate =   $borrowingQty - $req->qty;
                // dd($qtyupdate);
                // dd($req->qty);
                // dd($qtyupdate);
                $product->update(['qty' => $productQty + $qtyupdate]);
            }

        }
     
        return "Success";
    }
    public function returnBorrowing(Request $req, $id)
    {
        $borrowing =  Borrowing::findOrFail($id);
     
        // dd($borrowing->status);/
        $product = Product::findOrFail($borrowing->product_id);
        $borrowingQty = $borrowing->qty;
        $borrowingReturnQty = $borrowing->return_qty;
        $productQty = $product->qty;
        $borrowing->update($req->all());
        // dd($req->status);
        if ($borrowing->status == 'borrowing') {
            
            $borrowing->update(['return_qty' => $borrowingQty]);
            $borrowing->update(['status' => "Return"]);
            $product->update(['qty' => $productQty + $borrowingQty]);
        }
        
        return "Success";
    }

    public function cancelBorrowing (Request $req, $id)
    {
        $borrowing =  Borrowing::findOrFail($id);
     
        // dd($borrowing);
        $product = Product::findOrFail($borrowing->product_id);
        $borrowingQty = $borrowing->qty;
        $borrowingReturnQty = $borrowing->return_qty;
        $productQty = $product->qty;
        $borrowing->update($req->all());
        if ($borrowing->status == 'borrowing') {
            // dd($req->status);
            $borrowing->update(['return_qty' => $borrowingQty]);
            $borrowing->update(['status' => "Cancel"]);
            $product->update(['qty' => $productQty + $borrowingQty]);
        }
        
        return "Success";
    }
    public function getallproduct()
    {

        $data = Product::select('id', 'name')->get();
        return $data;
    }
    public function getallstudent()
    {
        $data = Students::select('id', 'name')->get();
        return $data;
    }
    public function getallroom()
    {
        $data = Room::select('id', 'name')->get();
        // dd($data);
        return $data;
    }
    public function getupdateqty()
    {

        $data = Product::select('id', 'name')->get();
        return $data;
    }
}
