<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $fillable = ['slug', 'name'];
    
    /**
     * Override the constructor to create default slugs.
     * 
     * @param type $attributes
     */
    function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->cleanSlug();
    }
    
    /**
     * Force the slug to be lowercase. If no slug is specified,
     * use the name field by default.
     * 
     * @return string
     */
    protected function cleanSlug() {
        if( $this->slug == '' ) {
            $this->slug = strtolower($this->name);
        }
        else {
            $this->slug = strtolower($this->slug);
        }
    }
    
    /**
     * Override the save function to verify a name is present and to force a
     * lowercase slug.
     * 
     * @todo remove special characters from slugs
     * @todo split into SlugModel class
     * 
     * @param array $options
     */
    public function save(array $options = array()) {
        if( ( !isset( $this->slug) || $this->slug == '') && ( !isset( $this->name) || $this->name == '') ) {
            return false;
        }
        $this->cleanSlug();
        parent::save($options);
    }
}
