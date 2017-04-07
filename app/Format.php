<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Format extends SlugModel
{
    protected $fillable = ['slug', 'name'];
}
