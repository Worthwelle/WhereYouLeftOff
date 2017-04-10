<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class ChapterSet extends Model
{
    protected $fillable = ['chapters'];
    protected $casts = ['chapters' => 'array'];
}
