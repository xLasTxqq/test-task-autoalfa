<?php

namespace Tests\Feature\Api\v1\Publisher;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StorePublisherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_publisher_store_is_not_working_without_auth()
    {
        $response = $this->postJson('/api/v1/publisher', Publisher::factory()->create()->toArray());

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_publisher_store_is_not_working_without_permissions()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->postJson('/api/v1/publisher', Publisher::factory()->create()->toArray());

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_publisher_store_is_not_working_without_validate()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/publisher');

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => []]);
    }

    public function test_route_publisher_store_is_working()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        $publisherCreated = Publisher::factory()->create()->toArray();

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/publisher', $publisherCreated);

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => []])
            ->assertJsonPath('data.name', $publisherCreated['name']);
    }
}
