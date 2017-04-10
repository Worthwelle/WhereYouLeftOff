<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = ['title', 'description'];
    
    /**
     * The resources in this series.
     */
    public function resources()
    {
        return $this->hasMany('WhereYouLeftOff\Resource');
    }
}
