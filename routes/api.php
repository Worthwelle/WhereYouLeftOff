<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'], 'prefix' => '/v1'], function () {
    Route::get('/version', function() {
        return response()->json([
            'app' => config('app.name'),
            'version' => config('app.version'),
        ]);
    });
    Route::resource('series', 'SeriesController');
    Route::resource('medium', 'MediumController');
    Route::resource('resource', 'ResourceController');
    Route::resource('creator', 'CreatorController');
    Route::resource('creator_title', 'CreatorTitleController');
    Route::resource('chapter_set', 'ChapterSetController');
    Route::resource('format', 'FormatController');
    Route::resource('edition', 'EditionController');
    Route::resource('review', 'ReviewController');
    Route::resource('resource_creator', 'ResourceCreatorController');
    Route::resource('tag', 'TagController');
    Route::resource('review_tag', 'ReviewTagController');
});
