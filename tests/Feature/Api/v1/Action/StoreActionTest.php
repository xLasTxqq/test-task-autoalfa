<?php

namespace Tests\Feature\Api\v1\Action;

use App\Models\Action;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreActionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_action_store_is_not_working_without_auth()
    {
        $response = $this->postJson('/api/v1/action', Action::factory()->create()->toArray());

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_store_is_not_working_without_permissions()
    {

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->postJson('/api/v1/action', Action::factory()->create()->toArray());

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_action_store_is_not_working_without_validate()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/action');

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => []]);
    }

    public function test_route_action_store_is_working()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->postJson('/api/v1/action', Action::factory()->create()->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
