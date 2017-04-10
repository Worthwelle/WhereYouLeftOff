<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class ChapterSet extends Model
{
    protected $fillable = ['chapters'];
    protected $casts = ['chapters' => 'array'];
    
    /**
     * The editions that use the chapter set.
     */
    public function editions()
    {
        return $this->belongsToMany('WhereYouLeftOff\Edition');
    }
}
