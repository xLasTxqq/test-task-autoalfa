<?php

namespace Tests\Feature\Api\v1\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexAuthorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_author_index_is_working()
    {
        $response = $this->getJson('/api/v1/author');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
