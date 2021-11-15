<?php

namespace App\Http\Controllers;


use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Resources\CategoriesResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = Category::all();

        
        $search =  $request->input('keyword');
        $department =DB::table('categories')->select('categories.id','categories.name','categories.description');
         if ($request->input('keyword')) {
          $department->where('categories.name', 'LIKE', '%' . $search . '%');
          }
          // $department = DB::table('departments')->paginate(10);
          $data['categories'] = CategoriesResource::Pagination($department->paginate(6));
          return $this->successWithData($data);


        // $category = DB::table('categories')->paginate(6);
        // $data['categories'] = CategoriesResource::Pagination($category);
        // return $this->successWithData($data);
        // return $data;
    }

    /**
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        try {
            $category = new Category($req->all());
            $category->save();
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
        $data = Category::where('id', $id)->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $category =  Category::findOrFail($id);
        //   dd($req->all());
        $category->update($req->all());
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
        $category =  Category::findOrFail($id);
        //   dd($req->all());
        $isRelation = false;
        foreach (Category::RELATION_METHOD as $relationMethod) {
            $count = $category->$relationMethod()->count();
            if($count > 0 ) {
                $isRelation = true;
            }
        }
        dd($count);
        if(!$isRelation) {
            $category->delete();
            return "Success";
        }
        return 'This Product is relation to another, cannot delete';
    }
    //     $category->delete();
    //     //   dd($department);
    //     return "Success";
    // }

    public function getCategoryWithProduct($id)
    {
        $data = Category::where('id', $id)->with('product')->get();
        return $data;
        
    }
}
