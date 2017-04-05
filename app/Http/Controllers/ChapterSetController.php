<?php

namespace WhereYouLeftOff\Http\Controllers;

use WhereYouLeftOff\ChapterSet;
use Illuminate\Http\Request;

class ChapterSetController extends Controller
{
    /**
     * Display a listing of the chapter set.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new chapter set.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created chapter set in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'chapters' => 'required'
        ]);
        
        $data = $request->all();
        $set = new ChapterSet($data);
        $set->save();
        return $set;
    }

    /**
     * Display the specified chapter set.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $set = ChapterSet::findOrFail($id);
        return $set;
    }

    /**
     * Show the form for editing the specified chapter set.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified chapter set in storage.
     *
     * @todo verify the medium is not set to null.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'chapters' => 'required'
        ]);
        $set = ChapterSet::find($id);
        if( !$set ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $set->fill($data);
        $set->save();
        return $set;
    }

    /**
     * Remove the specified chapter set from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $set = ChapterSet::find($id);
        if( !$set ) {
            return ['error' => '404'];
        }
        $set->delete();
    }
}
