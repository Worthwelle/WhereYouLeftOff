<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = ['title', 'resource_id', 'chapter_set_id', 'format_id', 'keys'];
    protected $casts = ['keys' => 'array'];
    
    /**
     * The creators of this edition.
     */
    public function creators()
    {
        return $this->belongsToMany('WhereYouLeftOff\Creator', 'resource_creators', 'edition_id', 'creator_id')
                ->withPivot('creator_title_id');
    }
    
    /**
     * The resource that this edition belongs to.
     */
    public function resource()
    {
        return $this->belongsTo('WhereYouLeftOff\Resource');
    }
    
    /**
     * The chapter set used by this edition.
     */
    public function chapter_set()
    {
        return $this->hasOne('WhereYouLeftOff\ChapterSet');
    }
    
    /**
     * The editions that belong to the chapter set.
     */
    public function format()
    {
        return $this->hasOne('WhereYouLeftOff\Format');
    }
}
