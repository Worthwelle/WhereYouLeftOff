<?php

namespace WhereYouLeftOff\Http\Controllers;

use Illuminate\Http\Request;
use WhereYouLeftOff\ReviewTag;

class ReviewTagController extends Controller
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
            'review_id' => 'required',
            'tag_id' => 'required'
        ]);
        
        $data = $request->all();
        $review_tag = new ReviewTag($data);
        $review_tag->save();
        return $review_tag;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review_tag = ReviewTag::findOrFail($id);
        return $review_tag;
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
        $review_tag = ReviewTag::find($id);
        if( !$review_tag ) {
            return ['error' => '404'];
        }
        $data = $request->all();
        $review_tag->fill($data);
        $review_tag->save();
        return $review_tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review_tag = ReviewTag::find($id);
        if( !$review_tag ) {
            return ['error' => '404'];
        }
        $review_tag->delete();
    }
}
