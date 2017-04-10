<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class CreatorTitle extends Model
{
    protected $fillable = ['title'];
    
    /**
     * The creators that have this title.
     */
    public function creators()
    {
        return $this->belongsToMany('WhereYouLeftOff\Creator', 'resource_creators', 'creator_title_id', 'creator_id');
    }
}
