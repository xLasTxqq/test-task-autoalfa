<?php

namespace Tests\Feature\Api\v1\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowBookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_book_show_is_working()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/v1/book/' . $book->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $book->id)
            ->assertJsonPath('data.name', $book->name);
    }

    public function test_route_book_show_is_not_working_with_false_id()
    {
        $response = $this->getJson("/api/v1/book/0");

        $response->assertStatus(404);
    }
}
