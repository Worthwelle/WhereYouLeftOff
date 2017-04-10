<?php

namespace WhereYouLeftOff\Http\Controllers;

use Illuminate\Http\Request;
use WhereYouLeftOff\Edition;

class EditionController extends Controller
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
            'title' => 'required',
            'resource_id' => 'required',
            'chapter_set_id' => 'required',
            'format_id' => 'required'
        ]);
        
        $data = $request->all();
        $edition = new Edition($data);
        $edition->save();
        return $edition;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edition = Edition::findOrFail($id);
        return $edition;
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
        $edition = Edition::find($id);
        if( !$edition ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $edition->fill($data);
        $edition->save();
        return $edition;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edition = Edition::find($id);
        if( !$edition ) {
            return ['error' => '404'];
        }
        $edition->delete();
    }
}
