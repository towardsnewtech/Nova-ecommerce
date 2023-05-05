<?php

namespace App\Http\Controllers;

use App\Models\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return OptionGroup::all();
    }

	 public function get($optionGroup)
    {
		$optionGroup = explode(",",$optionGroup);
		$result = array();
		$options = \DB::select('SELECT	l.id,	l.name,	st.price FROM OPTIONS l JOIN option_groups s ON s.id = l.group_id JOIN option_variant st ON st.option_id = l.id JOIN variants lt ON st.variant_id = lt.id WHERE lt.id=? AND s.id=?',[$optionGroup[1],$optionGroup[0]]);
		for($i=0;$i<count($options);$i++){				
			array_push($result,["id"=>$options[$i]->id, "name"=> json_decode($options[$i]->name),"price"=> $options[$i]->price]);		
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
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function show(OptionGroup $optionGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionGroup $optionGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionGroup $optionGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionGroup  $optionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionGroup $optionGroup)
    {
        //
    }
}
