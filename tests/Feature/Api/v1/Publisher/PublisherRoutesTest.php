<?php

namespace Tests\Feature\Feature\Api\v1\Publisher;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PublisherRoutesTest extends TestCase
{
    use RefreshDatabase;

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
    public function test_route_publisher_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/publisher');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_publisher_store_is_working()
    {
        $publisher = Publisher::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/publisher', $publisher->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $publisher->id)
            ->assertJsonPath('data.name', $publisher->name);
    }

    public function test_route_publisher_show_is_working()
    {
        $publisher = Publisher::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/publisher/' . $publisher->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $publisher->id)
            ->assertJsonPath('data.name', $publisher->name);
    }

    public function test_route_publisher_destroy_is_working()
    {
        $publisher = Publisher::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->deleteJson('/api/v1/publisher/' . $publisher->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $publisher->id)
            ->assertJsonPath('data.name', $publisher->name);
    }

    public function test_route_publisher_index_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/publisher');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_genre_store_is_not_working_without_auth()
    {
        $publisher = Publisher::factory()->create();

        $response = $this->postJson('/api/v1/publisher', $publisher->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_publisher_show_is_not_working_without_auth()
    {
        $publisher = Publisher::factory()->create();

        $response = $this->getJson('/api/v1/publisher/' . $publisher->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_publisher_destroy_is_not_working_without_auth()
    {
        $publisher = Publisher::factory()->create();

        $response = $this->deleteJson('/api/v1/publisher/' . $publisher->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
