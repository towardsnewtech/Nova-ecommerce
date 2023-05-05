<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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

	 public function get(Request $request)
    {
		$data = $request->data;
		if(DB::table('customers')->where('password', md5($data['password']))->where('email', $data['email'])->exists()){
			$result = DB::table('customers')->where('password', md5($data['password']))->where('email', $data['email'])->orderBy('created_at', 'desc')->first();
			return response()->json(["name" => $result->name,"email" => $result->email]);
		}else{
			return "fail";
		}
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
			DB::table('customers')->insert(array('name' =>  $data['name'], 'email' => $data['email'], 'phone' => '', 'password' => md5($data['password']), 'created_at'=>$cur_date ));
			return "ok";
		}else{
			return "fail";
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
