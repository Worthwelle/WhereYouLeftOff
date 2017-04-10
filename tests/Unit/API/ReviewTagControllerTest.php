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
use WhereYouLeftOff\Tag;
use WhereYouLeftOff\ReviewTag;

class ReviewTagControllerTest extends TestCase
{
    /**
     * Insert a review tag.
     *
     * @return void
     */
    public function testInsertReviewTag()
    {
        $user = User::create(['name' => 'ReviewTag Test User', 'email' => 'reviewtagtestuser@whereyouleftoff.com', 'password' => md5('this is my super secret password')]);
        $series = Series::create(['title' => 'ReviewTagReviewEditionResourceSeries']);
        $medium = Medium::create(['name' => 'ReviewTagReviewEditionResourceMedium']);
        $resource = Resource::create(['title' => 'ReviewTagReviewEditionResource', 'series_id' => $series->id, 'medium_id' => $medium->id]);
        $chapter_set = ChapterSet::create(['chapters' => [1 => 'ReviewTagReviewEditionChapterSet Chapter1', 2 => 'ReviewTagReviewEditionChapterSet Chapter2']]);
        $format = Format::create(['name' => 'ReviewTagReviewEditionFormat']);
        $edition = Edition::create(['title' => 'ReviewTagReviewEdition', 'resource_id' => $resource->id, 'chapter_set_id' => $chapter_set->id, 'format_id' => $format->id]);
        $review = Review::create(['title' => 'ReviewTagReview', 'user_id' => $user->id, 'edition_id' => $edition->id, 'spoilers' => true, 'content' => 'Review text will be here.']);
        $tag = Tag::create(['name' => 'ReviewTagTag']);
        
        $this->post('/api/v1/review_tag', ['review_id' => $review->id, 'tag_id' => $tag->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(['review_id' => $review->id, 'tag_id' => $tag->id]);
        $this->assertDatabaseHas('review_tags', ['review_id' => $review->id, 'tag_id' => $tag->id]);
    }
    
    /**
     * Retrieve a review tag.
     *
     * @depends testInsertReviewTag
     * @return void
     */
    public function testShowReviewTag()
    {
        $review = Review::where('title','ReviewTagReview')->firstOrFail();
        $tag = Tag::where('name','ReviewTagTag')->firstOrFail();
        $id = ReviewTag::where('review_id', $review->id)->where('tag_id', $tag->id)->firstOrFail()->id;
        $this->get('/api/v1/review_tag/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(['review_id' => $review->id, 'tag_id' => $tag->id]);
    }
    
    /**
     * Update a review tag.
     *
     * @depends testInsertReviewTag
     * @return void
     */
    public function testUpdateExistingReviewTag()
    {
        $review = Review::where('title','ReviewTagReview')->firstOrFail();
        $tag = Tag::where('name','ReviewTagTag')->firstOrFail();
        $id = ReviewTag::where('review_id', $review->id)->where('tag_id', $tag->id)->firstOrFail()->id;
        
        $tag2 = Tag::create(['name' => 'UpdatedReviewTagTag']);
        $this->put('/api/v1/review_tag/'.$id, ['review_id' => $review->id, 'tag_id' => $tag2->id], ['HTTP_X-Requested-With' => 'XMLHttpRequest'])
             ->assertJson(['review_id' => $review->id, 'tag_id' => $tag2->id]);
        $this->assertDatabaseHas('review_tags', ['review_id' => $review->id, 'tag_id' => $tag2->id]);
    }
    
    /**
     * Delete a review tag.
     * 
     * @depends testUpdateExistingReviewTag
     * @return void
     */
    public function testRemoveReviewTag() {
        $review = Review::where('title','ReviewTagReview')->firstOrFail();
        $tag = Tag::where('name','UpdatedReviewTagTag')->firstOrFail();
        $id = ReviewTag::where('review_id', $review->id)->where('tag_id', $tag->id)->firstOrFail()->id;
        $this->delete('/api/v1/review_tag/'.$id, ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertDatabaseMissing('review_tags', ['id' => $id]);
    }
}
