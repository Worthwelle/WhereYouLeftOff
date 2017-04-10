<?php

namespace WhereYouLeftOff\Http\Controllers;

use WhereYouLeftOff\Creator;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Display a listing of the creator.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new creator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created creator in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $data = $request->all();
        $creator = new Creator($data);
        $creator->save();
        return $creator;
    }

    /**
     * Display the specified creator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creator = Creator::findOrFail($id);
        return $creator;
    }

    /**
     * Show the form for editing the specified creator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified creator in storage.
     *
     * @todo verify the medium is not set to null.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $creator = Creator::find($id);
        if( !$creator ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $creator->fill($data);
        $creator->save();
        return $creator;
    }

    /**
     * Remove the specified creator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creator = Creator::find($id);
        if( !$creator ) {
            return ['error' => '404'];
        }
        $creator->delete();
    }
}
