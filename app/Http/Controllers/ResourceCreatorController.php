<?php

namespace WhereYouLeftOff\Http\Controllers;

use Illuminate\Http\Request;
use WhereYouLeftOff\ResourceCreator;

class ResourceCreatorController extends Controller
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
        $this->validate($request, [
            'edition_id' => 'required',
            'creator_id' => 'required',
            'creator_title_id' => 'required'
        ]);
        
        $data = $request->all();
        $resource_creator = new ResourceCreator($data);
        $resource_creator->save();
        return $resource_creator;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource_creator = ResourceCreator::findOrFail($id);
        return $resource_creator;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resource_creator = ResourceCreator::find($id);
        if( !$resource_creator ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $resource_creator->fill($data);
        $resource_creator->save();
        return $resource_creator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource_creator = ResourceCreator::find($id);
        if( !$resource_creator ) {
            return ['error' => '404'];
        }
        $resource_creator->delete();
    }
}
