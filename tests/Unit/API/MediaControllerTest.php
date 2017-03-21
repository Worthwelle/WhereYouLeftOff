<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Medium;

class MediaTest extends TestCase
{
    
    /**
     * Insert a media item without a custom slug.
     *
     * @return void
     */
    public function testInsertMediumWithoutSlug()
    {
        $this->post('/api/v1/medium', ['name' => 'MediumWithDefaultSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'mediumwithdefaultslug',
                 'name' => 'MediumWithDefaultSlug'
             ]);
        $this->assertDatabaseHas('media', ['slug' => 'mediumwithdefaultslug', 'name' => 'MediumWithDefaultSlug']);
    }
    
    /**
     * Retrieve a media item.
     *
     * @depends testInsertMediumWithoutSlug
     * @return void
     */
    public function testShowMedium()
    {
        $id = Medium::where('slug','mediumwithdefaultslug')->firstOrFail()->id;
        $this->get('/api/v1/medium/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'mediumwithdefaultslug',
                 'name' => 'MediumWithDefaultSlug'
             ]);
    }
    
    /**
     * Insert a media item with a custom slug.
     *
     * @return void
     */
    public function testInsertMediumWithCustomSlug()
    {
        $this->post('/api/v1/medium/', ['slug' => 'customSlug', 'name' => 'MediumWithCustomSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'MediumWithCustomSlug'
             ]);
        $this->assertDatabaseHas('media', ['slug' => 'customSlug', 'name' => 'MediumWithCustomSlug']);
    }
    
    /**
     * Update a media item.
     *
     * @depends testInsertMediumWithCustomSlug
     * @return void
     */
    public function testUpdateExistingMedium()
    {
        $id = Medium::where('name','MediumWithCustomSlug')->firstOrFail()->id;
        $this->put('/api/v1/medium/'.$id, ['name' => 'UpdatedMedium'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'UpdatedMedium',
             ]);
        $this->assertDatabaseHas('media', ['id' => $id, 'slug' => 'customSlug', 'name' => 'UpdatedMedium']);
    }
    
    /**
     * Update a non-existant media item.
     *
     * @return void
     */
    public function testUpdateNonExistantMedium()
    {
        $this->put('/api/v1/medium/10000', ['name' => 'NonExistingMedium'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'error' => '404',
             ]);
        $this->assertDatabaseMissing('media', ['id' => '1000']);
    }
    
    /**
     * Delete a media item
     * 
     * @depends testShowMedium
     * @return void
     */
    public function testRemoveMedium() {
        $id = Medium::where('slug','mediumwithdefaultslug')->firstOrFail()->id;
        $this->delete('/api/v1/medium/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('media', ['id' => $id]);
    }
}
