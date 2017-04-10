<?php

namespace Tests\Feature;

use Tests\TestCase;
use WhereYouLeftOff\Medium;
use WhereYouLeftOff\Series;
use WhereYouLeftOff\Resource;

class ResourceControllerTest extends TestCase
{
    /**
     * Insert a resource with a description.
     *
     * @todo add a series
     * @return void
     */
    public function testInsertResourceWithSeries()
    {
        $series = Series::create(['title' => 'ResourceSeries']);
        $medium = Medium::create(['name' => 'ResourceMedium']);
        
        $this->post('/api/v1/resource', ['title' => 'ResourceWithSeries', 'medium_id' => $medium->id, 'series_id' => $series->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'ResourceWithSeries',
                 'medium_id' => $medium->id,
                 'series_id' => $series->id
             ]);
        $this->assertDatabaseHas('resources', ['title' => 'ResourceWithSeries', 'medium_id' => $medium->id, 'series_id' => $series->id]);
    }
    
    /**
     * Retrieve a resource.
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
     * Insert a resource without a description.
     *
     * @return void
     */
    public function testInsertResourceWithoutSeries()
    {
        $medium = Medium::create(['name' => 'ResourceMedium2']);
        $this->post('/api/v1/resource', ['title' => 'ResourceWithOutSeries', 'medium_id' => $medium->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'ResourceWithOutSeries',
                 'medium_id' => $medium->id
             ]);
        $this->assertDatabaseHas('resources', ['title' => 'ResourceWithOutSeries', 'medium_id' => $medium->id]);
    }
    
    /**
     * Update a resource.
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
    
    /**
     * Delete a resource.
     * 
     * @depends testShowResource
     * @return void
     */
    public function testRemoveResource() {
        $id = Resource::where('title','UpdatedResource')->firstOrFail()->id;
        $this->delete('/api/v1/resource/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('resources', ['id' => $id]);
    }
}
