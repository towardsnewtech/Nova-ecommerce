<?php

namespace App\Http\Controllers;

use App\Models\FilterGroup;
use Illuminate\Http\Request;

class FilterGroupController extends Controller
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
			array_push($result,["id"=>0, "name"=> json_decode($group[$i]->name)]);
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
     * @param  \App\Models\FilterGroup  $filterGroup
     * @return \Illuminate\Http\Response
     */
    public function show(FilterGroup $filterGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilterGroup  $filterGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(FilterGroup $filterGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilterGroup  $filterGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilterGroup $filterGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilterGroup  $filterGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterGroup $filterGroup)
    {
        //
    }
}
