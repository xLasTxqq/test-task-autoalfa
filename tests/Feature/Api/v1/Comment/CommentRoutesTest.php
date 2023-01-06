<?php

namespace Tests\Feature\Api\v1\Comment;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommentRoutesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_comment_store_is_working()
    {
        $book = Book::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/comment', ['text' => fake()->sentence(), 'book_id' => $book->id]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_comment_store_is_not_working_without_auth()
    {
        $book = Book::factory()->create();
        $response = $this->postJson('/api/v1/comment', ['text' => fake()->sentence(), 'book_id' => $book->id]);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
