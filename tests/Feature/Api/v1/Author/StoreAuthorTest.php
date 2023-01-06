<?php

namespace Tests\Feature\Api\v1\Author;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreAuthorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_author_store_is_not_working_without_auth()
    {
        $response = $this->postJson('/api/v1/author', Author::factory()->create()->toArray());

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_author_store_is_not_working_without_permissions()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->postJson('/api/v1/author', Author::factory()->create()->toArray());

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_author_store_is_not_working_without_validate()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/author');

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => []]);
    }

    public function test_route_author_store_is_working()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        $createdAuthor = Author::factory()->create()->toArray();

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/author', $createdAuthor);

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.name', $createdAuthor['name']);
    }
}
