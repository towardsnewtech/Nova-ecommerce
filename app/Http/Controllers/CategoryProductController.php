<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Category::all();
        return CategoryProduct::all();
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function get($category, Request $request)
    {
		$data = $request->filter;
		$result = array();
		$sql = 'SELECT	DISTINCT l.id,	l.name,	l.price , l.description FROM products l JOIN category_products cp ON cp.product_id = l.id JOIN filter_product fp ON fp.product_id = l.id WHERE (1) ';
		if((int)$category !== 0){
			$sql .= ' AND cp.category_id='.$category;
		}
		for($i=0;$i<count($data);$i++)
		{
			if((int)$data[$i] !== 0){
				$sql .= ' AND fp.filter_id='.$data[$i];
			}
		}
		$product = \DB::select($sql);
		for($i=0;$i<count($product);$i++){				
			$image = \DB::select('SELECT * from media where model_id = ? and model_type like "%Product%" order by "id" desc',[$product[$i]->id]);
			if(count($image)>0){
				array_push($result,["id"=>$product[$i]->id,  "name"=>json_decode($product[$i]->name), "image"=>$image[0]->id."/".$image[0]->file_name,"price"=> $product[$i]->price,"description"=>json_decode($product[$i]->description)]);
			}else{
				array_push($result,["id"=>$product[$i]->id, "name"=> json_decode($product[$i]->name),"image"=>"","price"=> $product[$i]->price,"description"=>json_decode($product[$i]->description)]);
			}
		}
		return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
