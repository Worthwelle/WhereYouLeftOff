<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $fillable = ['name', 'bio', 'website'];
}
