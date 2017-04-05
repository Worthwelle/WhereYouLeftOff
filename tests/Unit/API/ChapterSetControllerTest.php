<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\ChapterSet;

class ChapterSetControllerTest extends TestCase
{
    
    /**
     * Insert a chapter set without a custom slug.
     *
     * @return void
     */
    public function testInsertChapterSet()
    {
        $chapters = [
            1 => 'Test Chapter'
        ];
        $this->post('/api/v1/chapter_set', ['chapters' => $chapters], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'chapters' => $chapters
             ]);
        $this->assertDatabaseHas('chapter_sets', ['chapters' => json_encode($chapters)]);
    }
    
    /**
     * Retrieve a chapter set.
     *
     * @depends testInsertChapterSet
     * @return void
     */
    public function testShowChapterSet()
    {
        $chapters = [
            1 => 'Test Chapter'
        ];
        $id = ChapterSet::where('chapters',json_encode($chapters))->firstOrFail()->id;
        $this->get('/api/v1/chapter_set/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'chapters' => $chapters
             ]);
    }
    
    /**
     * Update a chapter set.
     *
     * @depends testInsertChapterSet
     * @return void
     */
    public function testUpdateExistingChapterSet()
    {
        $chapters = [
            1 => 'Test Chapter'
        ];
        $chapters_update = [
            1 => 'Test Chapter Updated',
            2 => 'Test Second Chapter'
        ];
        $id = ChapterSet::where('chapters',json_encode($chapters))->firstOrFail()->id;
        $this->put('/api/v1/chapter_set/'.$id, ['chapters' => $chapters_update], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'chapters' => $chapters_update,
             ]);
        $this->assertDatabaseHas('chapter_sets', ['id' => $id, 'chapters' => json_encode($chapters_update)]);
    }
    
    /**
     * Update a non-existant chapter set.
     *
     * @return void
     */
    public function testUpdateNonExistantChapterSet()
    {
        $this->put('/api/v1/chapter_set/10000', ['chapters' => [1 => 'Test Chapter']], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'error' => '404',
             ]);
        $this->assertDatabaseMissing('chapter_sets', ['id' => '1000']);
    }
    
    /**
     * Delete a chapter set
     * 
     * @depends testUpdateExistingChapterSet
     * @return void
     */
    public function testRemoveChapterSet() {
        $chapters = [
            1 => 'Test Chapter Updated',
            2 => 'Test Second Chapter'
        ];
        $id = ChapterSet::where('chapters',json_encode($chapters))->firstOrFail()->id;
        $this->delete('/api/v1/chapter_set/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('chapter_sets', ['id' => $id]);
    }
}
