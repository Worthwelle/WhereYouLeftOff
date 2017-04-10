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
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('medium_id')->references('id')->on('media')->onDelete('cascade');
        });
        Schema::table('editions', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            $table->foreign('chapter_set_id')->references('id')->on('chapter_sets')->onDelete('cascade');
            $table->foreign('format_id')->references('id')->on('formats')->onDelete('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
        });
        Schema::table('resource_creators', function (Blueprint $table) {
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('creators')->onDelete('cascade');
            $table->foreign('creator_title_id')->references('id')->on('creator_titles')->onDelete('cascade');
        });
        Schema::table('review_tags', function (Blueprint $table) {
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
            $table->dropForeign('resource_creators_edition_id_foreign');
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
