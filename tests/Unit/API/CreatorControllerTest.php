<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\Creator;

class CreatorTest extends TestCase
{
    /**
     * Insert a creator item with a description.
     *
     * @return void
     */
    public function testInsertCreatorWithBioAndWebsite()
    {
        $this->post('/api/v1/creator',      ['name' => 'Creator With Bio And Website', 'bio' => 'This is a biography.', 'website' => 'http://whereyouleftoff.com/creator/CreatorWithBioAndWebsite'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(                  ['name' => 'Creator With Bio And Website', 'bio' => 'This is a biography.', 'website' => 'http://whereyouleftoff.com/creator/CreatorWithBioAndWebsite']);
        $this->assertDatabaseHas('creators', ['name' => 'Creator With Bio And Website', 'bio' => 'This is a biography.', 'website' => 'http://whereyouleftoff.com/creator/CreatorWithBioAndWebsite']);
    }
    
    /**
     * Retrieve a creator item.
     *
     * @depends testInsertCreatorWithBioAndWebsite
     * @return void
     */
    public function testShowCreator()
    {
        $id = Creator::where('name','Creator With Bio And Website')->firstOrFail()->id;
        $this->get('/api/v1/creator/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(['name' => 'Creator With Bio And Website']);
    }
    
    /**
     * Insert a creator item without a description.
     *
     * @return void
     */
    public function testInsertCreatorWithoutBioAndWebsite()
    {
        $this->post('/api/v1/creator', ['name' => 'Creator Without Bio And Website'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(['name' => 'Creator Without Bio And Website']);
        $this->assertDatabaseHas('creators', ['name' => 'Creator Without Bio And Website']);
    }
    
    /**
     * Update a creator item.
     *
     * @depends testInsertCreatorWithBioAndWebsite
     * @return void
     */
    public function testUpdateExistingCreator()
    {
        $id = Creator::where('name','Creator With Bio And Website')->firstOrFail()->id;
        $this->put('/api/v1/creator/'.$id, ['name' => 'Updated Creator'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'name' => 'Updated Creator',
             ]);
        $this->assertDatabaseHas('creators', ['id' => $id, 'name' => 'Updated Creator']);
    }
}
