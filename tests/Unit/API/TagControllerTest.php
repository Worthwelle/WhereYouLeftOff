<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Tag;

class TagControllerTest extends TestCase
{
    
    /**
     * Insert a tag without a custom slug.
     *
     * @return void
     */
    public function testInsertTagWithoutSlug()
    {
        $this->post('/api/v1/tag', ['name' => 'TagWithDefaultSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'tagwithdefaultslug',
                 'name' => 'TagWithDefaultSlug'
             ]);
        $this->assertDatabaseHas('tags', ['slug' => 'tagwithdefaultslug', 'name' => 'TagWithDefaultSlug']);
    }
    
    /**
     * Retrieve a tag.
     *
     * @depends testInsertTagWithoutSlug
     * @return void
     */
    public function testShowTag()
    {
        $id = Tag::where('slug','tagwithdefaultslug')->firstOrFail()->id;
        $this->get('/api/v1/tag/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'tagwithdefaultslug',
                 'name' => 'TagWithDefaultSlug'
             ]);
    }
    
    /**
     * Insert a tag with a custom slug.
     *
     * @return void
     */
    public function testInsertTagWithCustomSlug()
    {
        $this->post('/api/v1/tag/', ['slug' => 'customSlug', 'name' => 'TagWithCustomSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'TagWithCustomSlug'
             ]);
        $this->assertDatabaseHas('tags', ['slug' => 'customSlug', 'name' => 'TagWithCustomSlug']);
    }
    
    /**
     * Update a tag.
     *
     * @depends testInsertTagWithCustomSlug
     * @return void
     */
    public function testUpdateExistingTag()
    {
        $id = Tag::where('name','TagWithCustomSlug')->firstOrFail()->id;
        $this->put('/api/v1/tag/'.$id, ['name' => 'UpdatedTag'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'UpdatedTag',
             ]);
        $this->assertDatabaseHas('tags', ['id' => $id, 'slug' => 'customSlug', 'name' => 'UpdatedTag']);
    }
    
    /**
     * Update a non-existant tag.
     *
     * @return void
     */
    public function testUpdateNonExistantTag()
    {
        $this->put('/api/v1/tag/10000', ['name' => 'NonExistingTag'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'error' => '404',
             ]);
        $this->assertDatabaseMissing('tags', ['id' => '1000']);
    }
    
    /**
     * Delete a tag
     * 
     * @depends testShowTag
     * @return void
     */
    public function testRemoveTag() {
        $id = Tag::where('slug','tagwithdefaultslug')->firstOrFail()->id;
        $this->delete('/api/v1/tag/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('tags', ['id' => $id]);
    }
}
