<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Series;

class SeriesTest extends TestCase
{
    /**
     * Insert a series item with a description.
     *
     * @return void
     */
    public function testInsertSeriesWithDescription()
    {
        $this->post('/api/v1/series', ['title' => 'SeriesWithDescription', 'description' => 'This series has a description.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'SeriesWithDescription',
                 'description' => 'This series has a description.'
             ]);
        $this->assertDatabaseHas('series', ['title' => 'SeriesWithDescription', 'description' => 'This series has a description.']);
    }
    
    /**
     * Retrieve a series item.
     *
     * @depends testInsertSeriesWithDescription
     * @return void
     */
    public function testShowSeries()
    {
        $id = Series::where('title','SeriesWithDescription')->firstOrFail()->id;
        $this->get('/api/v1/series/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'SeriesWithDescription',
             ]);
    }
    
    /**
     * Insert a series item without a description.
     *
     * @return void
     */
    public function testInsertSeriesWithoutDescription()
    {
        $this->post('/api/v1/series', ['title' => 'SeriesWithoutDescription'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'SeriesWithoutDescription'
             ]);
        $this->assertDatabaseHas('series', ['title' => 'SeriesWithoutDescription']);
    }
    
    /**
     * Update a series item.
     *
     * @depends testInsertSeriesWithDescription
     * @return void
     */
    public function testUpdateExistingSeries()
    {
        $id = Series::where('title','SeriesWithDescription')->firstOrFail()->id;
        $this->put('/api/v1/series/'.$id, ['title' => 'UpdatedSeries'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'UpdatedSeries',
             ]);
        $this->assertDatabaseHas('series', ['id' => $id, 'title' => 'UpdatedSeries']);
    }
}
