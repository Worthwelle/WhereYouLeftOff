<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $fillable = ['name', 'bio', 'website'];
    
    /**
     * The editions that belong to the creator.
     */
    public function editions()
    {
        return $this->belongsToMany('WhereYouLeftOff\Edition', 'resource_creators', 'creator_id', 'edition_id');
    }
    
    /**
     * The titles that belong to the creator.
     */
    public function titles()
    {
        return $this->belongsToMany('WhereYouLeftOff\CreatorTitle', 'resource_creators', 'creator_id', 'creator_title_id');
    }
}
