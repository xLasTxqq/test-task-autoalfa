<?php

namespace Tests\Feature\Feature\Api\v1\Genre;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GenreRoutesTest extends TestCase
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
    public function test_route_genre_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/genre');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_genre_store_is_working()
    {
        $genre = Genre::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/genre', $genre->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $genre->id)
            ->assertJsonPath('data.name', $genre->name);
    }

    public function test_route_genre_show_is_working()
    {
        $genre = Genre::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/genre/' . $genre->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $genre->id)
            ->assertJsonPath('data.name', $genre->name);
    }

    public function test_route_genre_destroy_is_working()
    {
        $genre = Genre::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->deleteJson('/api/v1/genre/' . $genre->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $genre->id)
            ->assertJsonPath('data.name', $genre->name);
    }

    public function test_route_genre_index_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/genre');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_genre_store_is_not_working_without_auth()
    {
        $genre = Genre::factory()->create();

        $response = $this->postJson('/api/v1/genre', $genre->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_genre_show_is_not_working_without_auth()
    {
        $genre = Genre::factory()->create();

        $response = $this->getJson('/api/v1/genre/' . $genre->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_genre_destroy_is_not_working_without_auth()
    {
        $genre = Genre::factory()->create();

        $response = $this->deleteJson('/api/v1/genre/' . $genre->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
