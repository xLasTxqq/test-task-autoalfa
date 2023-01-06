<?php

namespace Tests\Feature\Api\v1\Genre;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexGenreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_genre_index_is_working()
    {
        $response = $this->getJson('/api/v1/genre');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
