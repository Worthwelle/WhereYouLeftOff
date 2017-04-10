<?php

namespace WhereYouLeftOff;

use WhereYouLeftOff\SlugModel;

class Tag extends SlugModel
{
    protected $fillable = ['slug', 'name'];
    
    /**
     * The reviews with this tag.
     */
    public function reviews()
    {
        return $this->belongsToMany('WhereYouLeftOff\Review', 'review_tags', 'tag_id', 'review_id');
    }
}
