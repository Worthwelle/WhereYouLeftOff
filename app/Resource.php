<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'series', 'medium'];
}
