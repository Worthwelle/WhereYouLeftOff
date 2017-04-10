<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class ReviewTag extends Model
{
    protected $fillable = ['review_id', 'tag_id'];
}
