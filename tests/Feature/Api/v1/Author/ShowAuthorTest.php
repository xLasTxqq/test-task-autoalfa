<?php

namespace Tests\Feature\Api\v1\Author;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowAuthorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_author_show_is_working()
    {
        $createdAuthor = Author::factory()->create();
        $response = $this->getJson("/api/v1/author/$createdAuthor->id");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
    public function test_route_author_show_is_not_working_with_false_id()
    {
        $response = $this->getJson("/api/v1/author/0");

        $response->assertStatus(404);
    }
}
