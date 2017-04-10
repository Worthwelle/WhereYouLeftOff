<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['title', 'user_id', 'edition_id', 'spoilers', 'chapter', 'content'];
    
    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo('WhereYouLeftOff\User');
    }
    
    /**
     * Get the user that owns the review.
     */
    public function edition()
    {
        return $this->belongsTo('WhereYouLeftOff\Edition');
    }
    
    /**
     * Get the user that owns the review.
     */
    public function tags()
    {
        return $this->belongsToMany('WhereYouLeftOff\Tag', 'review_tags', 'review_id', 'tag_id');
    }
}
