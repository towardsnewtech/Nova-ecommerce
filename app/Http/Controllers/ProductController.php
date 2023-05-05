<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
	public function get($product)
    {
		$tt = DB::table('products')->where('id', $product)->get();
		$image = \DB::select('SELECT * from media where model_id = ? and model_type like "%Product%" order by "id" desc',[$tt[0]->id]);
		$tax = \DB::select('SELECT * from taxes where id = ? order by "id" desc',[$tt[0]->tax_id]);
		if(count($image)>0){
			$result = ["id"=>$tt[0]->id,  "name"=>json_decode($tt[0]->name), "image"=>$image[0]->id."/".$image[0]->file_name,"price"=> $tt[0]->price,"description"=>json_decode($tt[0]->description),"tax_name"=>json_decode($tax[0]->name) ,"tax_percentage"=>$tax[0]->percentage];
		}else{
			$result = ["id"=>$tt[0]->id, "name"=> json_decode($tt[0]->name),"image"=>"","price"=> $tt[0]->price,"description"=>json_decode($tt[0]->description),"tax_name"=>json_decode($tax[0]->name), "tax_percentage"=>$tax[0]->percentage];
		}
        return response()->json($result);
        // return $category;
    }

    public function show(Product $product)
    {
        return $product->with('variants')->get();
    }

    public function variants(Product $product)
    {
        return $product->variants()->with('options')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
