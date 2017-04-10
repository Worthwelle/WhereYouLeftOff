<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Series;
use WhereYouLeftOff\Medium;
use WhereYouLeftOff\Resource;
use WhereYouLeftOff\ChapterSet;
use WhereYouLeftOff\Format;
use WhereYouLeftOff\Edition;

class EditionControllerTest extends TestCase
{
    /**
     * Insert an edition.
     *
     * @return void
     */
    public function testInsertEditionWithKeys()
    {
        $series = Series::create(['title' => 'EditionResourceSeries']);
        $medium = Medium::create(['name' => 'EditionResourceMedium']);
        $resource = Resource::create(['title' => 'EditionResource', 'series_id' => $series->id, 'medium_id' => $medium->id]);
        $chapter_set = ChapterSet::create(['chapters' => [1 => 'EditionChapterSet Chapter1', 2 => 'EditionChapterSet Chapter2']]);
        $format = Format::create(['name' => 'EditionFormat']);
        
        $payload = [
            'title' => 'Edition With Keys',
            'resource_id' => $resource->id,
            'chapter_set_id' => $chapter_set->id,
            'format_id' => $format->id,
            'keys' => [
                'isbn' => 123456789,
                'goodreads' => 123456789
            ]
        ];
        $this->post('/api/v1/edition', $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('editions', [
            'title' => 'Edition With Keys',
            'resource_id' => $resource->id,
            'chapter_set_id' => $chapter_set->id,
            'format_id' => $format->id,
            'keys' => json_encode([
                'isbn' => 123456789,
                'goodreads' => 123456789
            ])
        ]);
    }
    
    /**
     * Retrieve an edition.
     *
     * @depends testInsertEditionWithKeys
     * @return void
     */
    public function testShowEdition()
    {
        $id = Edition::where('title','Edition With Keys')->firstOrFail()->id;
        $this->get('/api/v1/edition/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Edition With Keys'
             ]);
    }
    
    /**
     * Insert an edition without a description.
     *
     * @return void
     */
    public function testInsertEditionWithoutKeys()
    {
        $resource = Resource::where('title','=','EditionResource')->firstOrFail();
        $format = Format::where('name','=','EditionFormat')->firstOrFail();
        $chapter_set = new ChapterSet(['chapters' => [1 => 'Edition2ChapterSet Chapter1', 2 => 'Edition2ChapterSet Chapter2']]);
        $chapter_set->save();
        
        
        $payload = [
            'title' => 'Edition Without Keys',
            'resource_id' => $resource->id,
            'chapter_set_id' => $chapter_set->id,
            'format_id' => $format->id
        ];
        $this->post('/api/v1/edition', $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('editions', $payload);
    }
    
    /**
     * Update an edition.
     *
     * @depends testInsertEditionWithKeys
     * @return void
     */
    public function testUpdateExistingEdition()
    {
        $id = Edition::where('title','Edition With Keys')->firstOrFail()->id;
        $this->put('/api/v1/edition/'.$id, ['title' => 'Updated Edition Without Keys'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Updated Edition Without Keys',
             ]);
        $this->assertDatabaseHas('editions', ['id' => $id, 'title' => 'Updated Edition Without Keys']);
    }
    
    /**
     * Delete an edition.
     * 
     * @depends testShowEdition
     * @return void
     */
    public function testRemoveEdition() {
        $id = Edition::where('title','Edition Without Keys')->firstOrFail()->id;
        $this->delete('/api/v1/edition/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('editions', ['id' => $id]);
    }
}
