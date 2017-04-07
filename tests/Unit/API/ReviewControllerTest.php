<?php

namespace Tests\Unit\API;

use Tests\TestCase;
use WhereYouLeftOff\User;
use WhereYouLeftOff\Series;
use WhereYouLeftOff\Medium;
use WhereYouLeftOff\Resource;
use WhereYouLeftOff\ChapterSet;
use WhereYouLeftOff\Format;
use WhereYouLeftOff\Edition;
use WhereYouLeftOff\Review;

class ReviewControllerTest extends TestCase
{
    /**
     * Insert a review.
     *
     * @return void
     */
    public function testInsertReviewWithTitle()
    {
        $user = User::create(['name' => 'Test User', 'email' => 'testuser@whereyouleftoff.com', 'password' => md5('this is my super secret password')]);
        $series = Series::create(['title' => 'ReviewEditionResourceSeries']);
        $medium = Medium::create(['name' => 'ReviewEditionResourceMedium']);
        $resource = Resource::create(['title' => 'ReviewEditionResource', 'series_id' => $series->id, 'medium_id' => $medium->id]);
        $chapter_set = ChapterSet::create(['chapters' => [1 => 'ReviewEditionChapterSet Chapter1', 2 => 'ReviewEditionChapterSet Chapter2']]);
        $format = Format::create(['name' => 'ReviewEditionFormat']);
        $edition = Edition::create(['title' => 'ReviewEdition', 'resource_id' => $resource->id, 'chapter_set_id' => $chapter_set->id, 'format_id' => $format->id]);
        
        $payload = [
            'title' => 'Review With Title',
            'user_id' => $user->id,
            'edition_id' => $edition->id,
            'spoilers' => true,
            'content' => 'Review text will be here.'
        ];
        $this->post('/api/v1/review', $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('reviews', $payload);
    }
    
    /**
     * Retrieve a review.
     *
     * @depends testInsertReviewWithTitle
     * @return void
     */
    public function testShowReview()
    {
        $id = Review::where('title','Review With Title')->firstOrFail()->id;
        $this->get('/api/v1/review/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Review With Title'
             ]);
    }
    
    /**
     * Insert a review without a description.
     *
     * @return void
     */
    public function testInsertReviewWithoutTitle()
    {
        $edition = Edition::where('title', '=', 'ReviewEdition')->firstOrFail();
        $user = User::where('email', '=', 'testuser@whereyouleftoff.com')->firstOrFail();
        
        $payload = [
            'user_id' => $user->id,
            'edition_id' => $edition->id,
            'spoilers' => true,
            'content' => 'Review text will be here too.'
        ];
        $this->post('/api/v1/review', $payload, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson($payload);
        $this->assertDatabaseHas('reviews', $payload);
    }
    
    /**
     * Update a review.
     *
     * @depends testInsertReviewWithoutTitle
     * @return void
     */
    public function testUpdateExistingReview()
    {
        $id = Review::where('content','Review text will be here too.')->firstOrFail()->id;
        $this->put('/api/v1/review/'.$id, ['title' => 'Updated Review Without Title'], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson([
                 'title' => 'Updated Review Without Title',
             ]);
        $this->assertDatabaseHas('reviews', ['id' => $id, 'title' => 'Updated Review Without Title']);
    }
    
    /**
     * Delete a review.
     * 
     * @depends testShowReview
     * @return void
     */
    public function testRemoveReview() {
        $id = Review::where('title','Review With Title')->firstOrFail()->id;
        $this->delete('/api/v1/review/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('reviews', ['id' => $id]);
    }
}
