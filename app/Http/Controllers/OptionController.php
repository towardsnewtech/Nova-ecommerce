<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
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

	 public function get($variant)
    {

		$result = array();
		$group = \DB::select('SELECT * from option_groups order by "id" desc');
		$result = array();
		for($i=0;$i<count($group);$i++){
			//array_push($result,["id"=>0, "name"=> json_decode($group[$i]->name),"price"=> 0,"type"=>"group"]);
			$options = \DB::select('SELECT	DISTINCT l.id,	l.name,	st.price FROM OPTIONS l JOIN option_groups s ON s.id = l.group_id JOIN option_variant st ON st.option_id = l.id JOIN variants lt ON st.variant_id = lt.id WHERE lt.id=? AND s.id=?',[$variant,$group[$i]->id]);
			for($j=0;$j<count($options);$j++){				
				array_push($result,["id"=>$options[$j]->id, "name"=> json_decode($options[$j]->name),"price"=> $options[$j]->price,"group"=>$i]);		
			}
		}
		return response()->json($result);
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
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
