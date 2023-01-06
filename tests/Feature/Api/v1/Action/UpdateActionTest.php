<?php

namespace Tests\Feature\Api\v1\Action;

use App\Models\Action;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateActionTest extends TestCase
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
    public function test_route_action_update_is_not_working_without_auth()
    {
        $actionCreated = Action::factory()->create();
        $response = $this->putJson("/api/v1/action/$actionCreated->id");

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_update_is_not_working_without_permissions()
    {
        $actionCreated = Action::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->putJson("/api/v1/action/$actionCreated->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_action_update_is_not_working_with_false_id()
    {
        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->putJson("/api/v1/action/0");

        $response->assertStatus(404);
    }

    public function test_route_action_update_is_working()
    {
        $actionCreated = Action::factory()->create();

        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->putJson("/api/v1/action/$actionCreated->id");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
