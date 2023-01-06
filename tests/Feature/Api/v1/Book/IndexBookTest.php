<?php

namespace Tests\Feature\Api\v1\Book;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexBookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_book_index_is_working()
    {
        $response = $this->getJson('/api/v1/book');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
