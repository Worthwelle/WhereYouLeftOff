<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->foreign('series_id')->references('id')->on('series');
            $table->foreign('medium_id')->references('id')->on('media');
        });
        Schema::table('editions', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->foreign('chapter_set_id')->references('id')->on('chapter_sets');
            $table->foreign('format_id')->references('id')->on('formats');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('edition_id')->references('id')->on('editions');
        });
        Schema::table('resource_creators', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->foreign('creator_id')->references('id')->on('creators');
            $table->foreign('creator_title_id')->references('id')->on('creator_titles');
        });
        Schema::table('review_tags', function (Blueprint $table) {
            $table->foreign('review_id')->references('id')->on('reviews');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_tags', function (Blueprint $table) {
            $table->dropForeign('review_tags_tag_id_foreign');
            $table->dropForeign('review_tags_review_id_foreign');
        });
        Schema::table('resource_creators', function (Blueprint $table) {
            $table->dropForeign('resource_creators_creator_title_id_foreign');
            $table->dropForeign('resource_creators_creator_id_foreign');
            $table->dropForeign('resource_creators_resource_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_edition_id_foreign');
            $table->dropForeign('reviews_user_id_foreign');
        });
        Schema::table('editions', function (Blueprint $table) {
            $table->dropForeign('editions_format_id_foreign');
            $table->dropForeign('editions_chapter_set_id_foreign');
            $table->dropForeign('editions_resource_id_foreign');
        });
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign('resources_medium_id_foreign');
            $table->dropForeign('resources_series_id_foreign');
        });
    }
}
