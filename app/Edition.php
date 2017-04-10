<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = ['title', 'resource_id', 'chapter_set_id', 'format_id', 'keys'];
    protected $casts = ['keys' => 'array'];
}
