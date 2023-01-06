<?php

namespace Tests\Feature\Api\v1\Subscribe;

use App\Models\Book;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubscriberRoutesTest extends TestCase
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
    public function test_route_subscriber_store_is_working()
    {
        $book = Book::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/subscriber', ['book_id' => $book->id]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_subscriber_destroy_is_working()
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user,
            ['*']
        );

        $subscriber = Subscriber::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/v1/subscriber/' . $subscriber->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $subscriber->id)
            ->assertJsonPath('data.name', $subscriber->name);
    }

    public function test_route_subscriber_store_is_not_working_without_auth()
    {
        $book = Book::factory()->create();
        $response = $this->postJson('/api/v1/subscriber', ['book_id' => $book->id]);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_subscriber_destroy_is_not_working_without_auth()
    {
        $user = User::factory()->create();
        $subscriber = Subscriber::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/v1/subscriber/' . $subscriber->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
