<?php

namespace Tests\Feature\Api\v1\Action;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class IndexActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_action_index_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/action');

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_index_is_not_working_without_permissions()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->getJson('/api/v1/action');

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_action_index_is_working()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        Permission::create(['name' => User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);

        $user = User::factory()->create();
        $user->givePermissionTo([User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS, User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->getJson('/api/v1/action');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
