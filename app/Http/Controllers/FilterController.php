<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = \DB::select('SELECT * from filter_groups order by "id" desc');
		$result = array();
		for($i=0;$i<count($group);$i++){
			//array_push($result,["id"=>0, "name"=> json_decode($group[$i]->name),"group"=>$group[$i]->id]);
			$list = DB::table('filters')->where('filter_group_id', $group[$i]->id)->get();
			for($j=0;$j<count($list);$j++){
				array_push($result,["id"=>$list[$j]->id, "name"=> json_decode($list[$j]->name),"group"=>$i]);
			}
		}
		return response()->json($result);
    }

	public function get($FilterGroup)
    {
		$list = DB::table('filters')->where('filter_group_id', $FilterGroup)->get();
		$result = array();
		for($i=0;$i<count($list);$i++){
			array_push($result,["id"=>$list[$i]->id, "name"=> json_decode($list[$i]->name)]);
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
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        //
    }
}
