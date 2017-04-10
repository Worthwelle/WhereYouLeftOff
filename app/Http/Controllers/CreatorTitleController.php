<?php

namespace WhereYouLeftOff\Http\Controllers;

use WhereYouLeftOff\CreatorTitle;
use Illuminate\Http\Request;

class CreatorTitleController extends Controller
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
            'title' => 'required'
        ]);
        
        $data = $request->all();
        $title = new CreatorTitle($data);
        $title->save();
        return $title;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = CreatorTitle::findOrFail($id);
        return $title;
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
        $title = CreatorTitle::find($id);
        if( !$title ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $title->fill($data);
        $title->save();
        return $title;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = CreatorTitle::find($id);
        if( !$title ) {
            return ['error' => '404'];
        }
        $title->delete();
    }
}
