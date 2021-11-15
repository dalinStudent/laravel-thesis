<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Products;
use Throwable;
use ProductsResource;
use App\Models\Product;
use App\Resources\ProductsResource as ResourcesProductsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =  $request->input('keyword');

        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.name as pname', 'products.khmer_name', 'products.category_id','products.model','products.serialnumber', 'products.qty', 'products.note', 'categories.name');
        if ($request->input('keyword')) {
            $products->where('products.name', 'LIKE', '%' . $search . '%');
        }
        $data['products'] = ResourcesProductsResource::Pagination($products->paginate(6));
        return $this->successWithData($data);
    }

    public function store(Request $req)
    {
        try {
            $product = new Product($req->all());
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
        $data = Product::where('id', $id)->get();
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
        $product =  Product::findOrFail($id);
        //   dd($req->all());
        $product->update($req->all());
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
        $product =  Product::findOrFail($id);
        $isRelation = false;
        foreach (Product::RELATION_METHOD as $relationMethod) {
            $count = $product->$relationMethod()->count();
            if ($count > 0) {
                $isRelation = true;
            }
        }
        if (!$isRelation) {
            $product->delete();
            return "Success";
        }
        return 'This Product is relation to another, cannot delete';
    }
    public function getallcategory()
    {
        $data = Category::select('id', 'name')->get();
        
        return $data;
    }

    public function getCategoryByProduct(Product $product)
    {
        $data = $product->with('category')->get();
        return $data;
    }

    public function getProductInStock()
    {
        $data = Product::select(['id', 'pname'])->where('qty', '>', 0)->get();
        return $data;
    }
}
