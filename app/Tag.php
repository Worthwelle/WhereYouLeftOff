<?php

namespace WhereYouLeftOff;

use WhereYouLeftOff\SlugModel;

class Tag extends SlugModel
{
    protected $fillable = ['slug', 'name'];
}
