<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorGenrePublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::truncate();
        Genre::truncate();
        Publisher::truncate();

        Author::factory(10)->create();
        Genre::factory(10)->create();
        Publisher::factory(10)->create();
    }
}
