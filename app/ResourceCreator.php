<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class ResourceCreator extends Model
{
    protected $fillable = ['edition_id', 'creator_id', 'creator_title_id'];
}
