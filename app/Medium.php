<?php

namespace WhereYouLeftOff;

use WhereYouLeftOff\SlugModel;

class Medium extends SlugModel
{
    protected $fillable = ['slug', 'name'];
    
    /**
     * The resources in this medium.
     */
    public function resources()
    {
        return $this->hasMany('WhereYouLeftOff\Resource');
    }
}
