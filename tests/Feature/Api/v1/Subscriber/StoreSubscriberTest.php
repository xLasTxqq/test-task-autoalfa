<?php

namespace Tests\Feature\Api\v1\Subscriber;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreSubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_subscriber_store_is_working()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_SUBSCRIBE_TO_BOOKS]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/subscriber', ['book_id' => $book->id]);

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_subscriber_store_is_not_working_without_auth()
    {
        $book = Book::factory()->create();
        $response = $this->postJson('/api/v1/subscriber', ['book_id' => $book->id]);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_subscriber_store_is_not_working_without_permissions()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/subscriber', ['book_id' => $book->id]);

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_subscriber_store_is_not_working_without_validate()
    {
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_SUBSCRIBE_TO_BOOKS]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/subscriber', ['book_id' => 0]);

        $response->assertStatus(422)
        ->assertJsonStructure(['errors' => []]);
    }
}
