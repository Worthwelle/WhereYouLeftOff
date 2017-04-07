<?php

namespace WhereYouLeftOff;

use Illuminate\Database\Eloquent\Model;

class SlugModel extends Model
{   
    /**
     * Force the slug to be lowercase and remove spaces. If no slug is
     * specified, use the name field by default.
     * 
     * @return string
     */
    protected function cleanSlug() {
        if( $this->slug == '' ) {
            $this->slug = $this->name;
        }
        $this->slug = strtolower($this->slug);
        $this->slug = str_replace(' ', '_', $this->slug);
    }
    
    /**
     * Override the save function to verify a name is present and to clean the
     * slug.
     * 
     * @todo remove special characters from slugs
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
