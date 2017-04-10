<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'series_id', 'medium_id'];
    
    /**
     * The medium this resource belongs to.
     */
    public function medium()
    {
        return $this->belongsTo('WhereYouLeftOff\Medium');
    }
    
    /**
     * The editions in this format.
     */
    public function editions()
    {
        return $this->belongsToMany('WhereYouLeftOff\Edition');
    }
    
    /**
     * The series this resource belongs to.
     */
    public function series()
    {
        return $this->belongsTo('WhereYouLeftOff\Series');
    }
}
