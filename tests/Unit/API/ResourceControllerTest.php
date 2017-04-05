<?php

namespace Tests\Feature;

use Tests\TestCase;
use WhereYouLeftOff\Medium;
use WhereYouLeftOff\Series;
use WhereYouLeftOff\Resource;

class ResourceControllerTest extends TestCase
{
    /**
     * Insert a series item with a description.
     *
     * @todo add a series
     * @return void
     */
    public function testInsertResourceWithSeries()
    {
        $series = new Series(['title' => 'ResourceSeries']);
        $series->save();
        $medium = new Medium(['name' => 'ResourceMedium']);
        $medium->save();
        $id = Medium::where('slug','book')->firstOrFail()->id;
        $this->post('/api/v1/resource', ['title' => 'ResourceWithSeries', 'medium_id' => $medium->id, 'series_id' => $series->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'ResourceWithSeries',
                 'medium_id' => $medium->id,
                 'series_id' => $series->id
             ]);
        $this->assertDatabaseHas('resources', ['title' => 'ResourceWithSeries', 'medium_id' => $medium->id, 'series_id' => $series->id]);
    }
    
    /**
     * Retrieve a series item.
     *
     * @depends testInsertResourceWithSeries
     * @return void
     */
    public function testShowResource()
    {
        $id = Resource::where('title','ResourceWithSeries')->firstOrFail()->id;
        $this->get('/api/v1/resource/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'ResourceWithSeries',
             ]);
    }
    
    /**
     * Insert a series item without a description.
     *
     * @return void
     */
    public function testInsertResourceWithoutSeries()
    {
        $medium = new Medium(['name' => 'ResourceMedium2']);
        $medium->save();
        $this->post('/api/v1/resource', ['title' => 'ResourceWithOutSeries', 'medium_id' => $medium->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'ResourceWithOutSeries',
                 'medium_id' => $medium->id
             ]);
        $this->assertDatabaseHas('resources', ['title' => 'ResourceWithOutSeries', 'medium_id' => $medium->id]);
    }
    
    /**
     * Update a series item.
     *
     * @depends testInsertResourceWithSeries
     * @return void
     */
    public function testUpdateExistingResource()
    {
        $id = Resource::where('title','ResourceWithSeries')->firstOrFail()->id;
        $this->put('/api/v1/resource/'.$id, ['title' => 'UpdatedResource'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'UpdatedResource',
             ]);
        $this->assertDatabaseHas('resources', ['id' => $id, 'title' => 'UpdatedResource']);
    }
}
