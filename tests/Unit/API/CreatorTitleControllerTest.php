<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\CreatorTitle;

class CreatorTitleTest extends TestCase
{
    
    /**
     * Insert a creator title without a custom slug.
     *
     * @return void
     */
    public function testInsertCreatorTitle()
    {
        $this->post('/api/v1/creator_title', ['title' => 'Creator Title'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Creator Title'
             ]);
        $this->assertDatabaseHas('creator_titles', ['title' => 'Creator Title']);
    }
    
    /**
     * Retrieve a creator title.
     *
     * @depends testInsertCreatorTitle
     * @return void
     */
    public function testShowCreatorTitle()
    {
        $id = CreatorTitle::where('title','Creator Title')->firstOrFail()->id;
        $this->get('/api/v1/creator_title/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Creator Title'
             ]);
    }
    
    /**
     * Update a creator title.
     *
     * @depends testInsertCreatorTitle
     * @return void
     */
    public function testUpdateExistingCreatorTitle()
    {
        $id = CreatorTitle::where('title','Creator Title')->firstOrFail()->id;
        $this->put('/api/v1/creator_title/'.$id, ['title' => 'Updated Creator Title'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Updated Creator Title',
             ]);
        $this->assertDatabaseHas('creator_titles', ['id' => $id, 'title' => 'Updated Creator Title']);
    }
    
    /**
     * Update a non-existant creator title.
     *
     * @return void
     */
    public function testUpdateNonExistantCreatorTitle()
    {
        $this->put('/api/v1/creator_title/10000', ['title' => 'NonExistingCreatorTitle'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'error' => '404',
             ]);
        $this->assertDatabaseMissing('creator_titles', ['id' => '1000']);
    }
    
    /**
     * Delete a creator title
     * 
     * @depends testShowCreatorTitle
     * @return void
     */
    public function testRemoveCreatorTitle() {
        $id = CreatorTitle::where('title','Updated Creator Title')->firstOrFail()->id;
        $this->delete('/api/v1/creator_title/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('creator_titles', ['id' => $id]);
    }
}
