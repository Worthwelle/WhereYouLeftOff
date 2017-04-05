<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Format;

class FormatTest extends TestCase
{
    
    /**
     * Insert a format item without a custom slug.
     *
     * @return void
     */
    public function testInsertFormatWithoutSlug()
    {
        $this->post('/api/v1/format', ['name' => 'FormatWithDefaultSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'formatwithdefaultslug',
                 'name' => 'FormatWithDefaultSlug'
             ]);
        $this->assertDatabaseHas('formats', ['slug' => 'formatwithdefaultslug', 'name' => 'FormatWithDefaultSlug']);
    }
    
    /**
     * Retrieve a format item.
     *
     * @depends testInsertFormatWithoutSlug
     * @return void
     */
    public function testShowFormat()
    {
        $id = Format::where('slug','formatwithdefaultslug')->firstOrFail()->id;
        $this->get('/api/v1/format/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'formatwithdefaultslug',
                 'name' => 'FormatWithDefaultSlug'
             ]);
    }
    
    /**
     * Insert a format item with a custom slug.
     *
     * @return void
     */
    public function testInsertFormatWithCustomSlug()
    {
        $this->post('/api/v1/format/', ['slug' => 'customSlug', 'name' => 'FormatWithCustomSlug'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'FormatWithCustomSlug'
             ]);
        $this->assertDatabaseHas('formats', ['slug' => 'customSlug', 'name' => 'FormatWithCustomSlug']);
    }
    
    /**
     * Update a format item.
     *
     * @depends testInsertFormatWithCustomSlug
     * @return void
     */
    public function testUpdateExistingFormat()
    {
        $id = Format::where('name','FormatWithCustomSlug')->firstOrFail()->id;
        $this->put('/api/v1/format/'.$id, ['name' => 'UpdatedFormat'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'slug' => 'customslug',
                 'name' => 'UpdatedFormat',
             ]);
        $this->assertDatabaseHas('formats', ['id' => $id, 'slug' => 'customSlug', 'name' => 'UpdatedFormat']);
    }
    
    /**
     * Update a non-existant format item.
     *
     * @return void
     */
    public function testUpdateNonExistantFormat()
    {
        $this->put('/api/v1/format/10000', ['name' => 'NonExistingFormat'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'error' => '404',
             ]);
        $this->assertDatabaseMissing('formats', ['id' => '1000']);
    }
    
    /**
     * Delete a format item
     * 
     * @depends testShowFormat
     * @return void
     */
    public function testRemoveFormat() {
        $id = Format::where('slug','formatwithdefaultslug')->firstOrFail()->id;
        $this->delete('/api/v1/format/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('formats', ['id' => $id]);
    }
}
