<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media')->insert([ 'slug' => "book", 'name' => "Book" ]);
        DB::table('media')->insert([ 'slug' => "game", 'name' => "Game" ]);
        DB::table('media')->insert([ 'slug' => "tv", 'name' => "TV Series" ]);
        DB::table('media')->insert([ 'slug' => "movie", 'name' => "Movie" ]);
    }
}
