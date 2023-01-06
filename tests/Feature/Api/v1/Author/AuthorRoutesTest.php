<?php

namespace Tests\Feature\Feature\Api\v1\Author;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthorRoutesTest extends TestCase
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
    public function test_route_author_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/author');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_author_store_is_working()
    {
        $author = Author::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/author', $author->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $author->id)
            ->assertJsonPath('data.name', $author->name);
    }

    public function test_route_author_show_is_working()
    {
        $author = Author::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->getJson('/api/v1/author/' . $author->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $author->id)
            ->assertJsonPath('data.name', $author->name);
    }

    public function test_route_author_destroy_is_working()
    {
        $author = Author::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->deleteJson('/api/v1/author/' . $author->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.id', $author->id)
            ->assertJsonPath('data.name', $author->name);
    }

    public function test_route_author_index_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/author');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_author_store_is_not_working_without_auth()
    {
        $author = Author::factory()->create();

        $response = $this->postJson('/api/v1/author', $author->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_author_show_is_not_working_without_auth()
    {
        $author = Author::factory()->create();

        $response = $this->getJson('/api/v1/author/' . $author->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_author_destroy_is_not_working_without_auth()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson('/api/v1/author/' . $author->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
