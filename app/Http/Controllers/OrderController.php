<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
		$cur_date = date('Y-m-d H:i:s');
		$data = $request->data;
		if(!DB::table('customers')->where('email', $data['email'])->exists()){
			return  "fail";
		}
		$result = DB::table('customers')->where('email', $data['email'])->orderBy('created_at', 'desc')->first();
		$customer_id = $result->id;
		DB::table('orders')->insert(  array('customer_id' =>  $customer_id, 'status' => '1', 'created_at'=>$cur_date,'store_id' => $data['store'],'Date' => $data['date'],'time' => $data['time']));
		$result = DB::table('orders')->orderBy('created_at', 'desc')->first();
		$order_id = $result->id;
		DB::table('order_items')->insert(  array('order_id' =>  $order_id, 'product_id' => $data['product_id'], 'variant_id' => $data['variant'] , 'price' => $data['price'],'quantity' =>0,'discount' =>0,'subtotal' =>0,'tax' =>0,'tax_id' =>0,'total' =>0, 'created_at'=>$cur_date,'additional_comments' => $data['addComments'],'comments' => $data['yourWish'],'additional_image' => $data['addImage'] ));
		$result = DB::table('order_items')->orderBy('created_at', 'desc')->first();
		$order_item_id = $result->id;
		$temp = explode(",",$data['option']);
		for($i=0;$i<count($temp);$i++){
			if($temp[$i] !== '0'){
				$in = intval($temp[$i]);
				DB::table('option_order_item')->insert( array('option_id' =>$in, 'order_item_id' => $order_item_id, 'price' => $data['price'] ));
			}
		}
		
        return  "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
