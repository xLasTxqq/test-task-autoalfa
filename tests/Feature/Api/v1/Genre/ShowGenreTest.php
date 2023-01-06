<?php

namespace Tests\Feature\Api\v1\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowGenreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_genre_show_is_working()
    {
        $createdGenre = Genre::factory()->create();
        $response = $this->getJson("/api/v1/genre/$createdGenre->id");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
    public function test_route_genre_show_is_not_working_with_false_id()
    {
        $response = $this->getJson("/api/v1/genre/0");

        $response->assertStatus(404);
    }
}
