<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Series;
use WhereYouLeftOff\Medium;
use WhereYouLeftOff\Resource;
use WhereYouLeftOff\ChapterSet;
use WhereYouLeftOff\Format;
use WhereYouLeftOff\Edition;
use WhereYouLeftOff\Creator;
use WhereYouLeftOff\CreatorTitle;
use WhereYouLeftOff\ResourceCreator;

class ResourceCreatorControllerTest extends TestCase
{
    /**
     * Insert a resource creator.
     *
     * @return void
     */
    public function testInsertResourceCreator()
    {
        $series = Series::create(['title' => 'ResourceCreatorResourceSeries']);
        $medium = Medium::create(['name' => 'ResourceCreatorResourceMedium']);
        $resource = Resource::create(['title' => 'ResourceCreatorResource', 'series_id' => $series->id, 'medium_id' => $medium->id]);
        $chapter_set = ChapterSet::create(['chapters' => [1 => 'ResourceCreatorEditionChapterSet Chapter1', 2 => 'ResourceCreatorEditionChapterSet Chapter2']]);
        $format = Format::create(['name' => 'ResourceCreatorEditionFormat']);
        $edition = Edition::create(['title' => 'ResourceCreatorEdition', 'resource_id' => $resource->id, 'chapter_set_id' => $chapter_set->id, 'format_id' => $format->id]);
        $creator = Creator::create(['name' => 'ResourceCreatorCreator']);
        $creator_title = CreatorTitle::create(['title' => 'ResourceCreatorCreatorTitle']);
        
        $payload = [
            'edition_id' => $edition->id,
            'creator_id' => $creator->id,
            'creator_title_id' => $creator_title->id
        ];
        $this->post('/api/v1/resource_creator', $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('resource_creators', $payload);
    }
    
    /**
     * Retrieve a resource creator.
     *
     * @depends testInsertResourceCreator
     * @return void
     */
    public function testShowResourceCreator()
    {
        $edition = Edition::where('title', 'ResourceCreatorEdition')->firstOrFail();
        $creator = Creator::where('name', 'ResourceCreatorCreator')->firstOrFail();
        $creator_title = CreatorTitle::where('title', 'ResourceCreatorCreatorTitle')->firstOrFail();
        
        $id = ResourceCreator::where('edition_id',$edition->id)->where('creator_id',$creator->id)->where('creator_title_id',$creator_title->id)->firstOrFail()->id;
        $this->get('/api/v1/resource_creator/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'edition_id' => $edition->id,
                 'creator_id' => $creator->id,
                 'creator_title_id' => $creator_title->id
             ]);
    }
    
    /**
     * Update a resource creator.
     *
     * @depends testInsertResourceCreator
     * @return void
     */
    public function testUpdateExistingReview()
    {
        $edition = Edition::where('title', 'ResourceCreatorEdition')->firstOrFail();
        $creator = Creator::where('name', 'ResourceCreatorCreator')->firstOrFail();
        $creator_title = CreatorTitle::where('title', 'ResourceCreatorCreatorTitle')->firstOrFail();
        
        $series = Series::create(['title' => 'ResourceCreator2ResourceSeries']);
        $medium = Medium::create(['name' => 'ResourceCreator2ResourceMedium']);
        $resource = Resource::create(['title' => 'ResourceCreator2Resource', 'series_id' => $series->id, 'medium_id' => $medium->id]);
        $chapter_set = ChapterSet::create(['chapters' => [1 => 'ResourceCreator2EditionChapterSet Chapter1', 2 => 'ResourceCreator2EditionChapterSet Chapter2']]);
        $format = Format::create(['name' => 'ResourceCreator2EditionFormat']);
        $edition2 = Edition::create(['title' => 'ResourceCreator2Edition', 'resource_id' => $resource->id, 'chapter_set_id' => $chapter_set->id, 'format_id' => $format->id]);
        $creator2 = Creator::create(['name' => 'ResourceCreator2Creator']);
        $creator_title2 = CreatorTitle::create(['title' => 'ResourceCreator2CreatorTitle']);
        
        $payload = [
                 'edition_id' => $edition2->id,
                 'creator_id' => $creator2->id,
                 'creator_title_id' => $creator_title2->id
        ];
        $id = ResourceCreator::where('edition_id',$edition->id)->where('creator_id',$creator->id)->where('creator_title_id',$creator_title->id)->firstOrFail()->id;
        $this->put('/api/v1/resource_creator/'.$id, $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('resource_creators', $payload);
    }
    
    /**
     * Delete a resource creator.
     * 
     * @depends testShowResourceCreator
     * @return void
     */
    public function testRemoveReview() {
        $edition = Edition::where('title', 'ResourceCreator2Edition')->firstOrFail();
        $creator = Creator::where('name', 'ResourceCreator2Creator')->firstOrFail();
        $creator_title = CreatorTitle::where('title', 'ResourceCreator2CreatorTitle')->firstOrFail();
        
        $id = ResourceCreator::where('edition_id',$edition->id)->where('creator_id',$creator->id)->where('creator_title_id',$creator_title->id)->firstOrFail()->id;
        $this->delete('/api/v1/resource_creator/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('resource_creators', ['id' => $id]);
    }
}
