<?php

namespace WhereYouLeftOff;

use WhereYouLeftOff\SlugModel;

class Format extends SlugModel
{
    protected $fillable = ['slug', 'name'];
    
    /**
     * The editions in this format.
     */
    public function editions()
    {
        return $this->belongsToMany('WhereYouLeftOff\Edition');
    }
}
