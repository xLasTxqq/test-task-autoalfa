<?php

namespace Tests\Feature\Api\v1\Action;

use App\Events\BookCanBeBookedEvent;
use App\Jobs\SendMailAboutBookJob;
use App\Listeners\BookCanBeBookedEmailNotification;
use App\Models\Action;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DestroyActionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_action_destroy_is_not_working_without_auth()
    {
        $actionCreated = Action::factory()->create();
        $response = $this->deleteJson("/api/v1/action/$actionCreated->id");

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_destroy_is_not_working_without_permissions()
    {
        $actionCreated = Action::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->deleteJson("/api/v1/action/$actionCreated->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_action_destroy_is_not_working_with_false_id()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        Permission::create(['name' => User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);
        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS,
            User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS
        ]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/action/0");

        $response->assertStatus(404);
    }

    public function test_route_action_destroy_is_working()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        Permission::create(['name' => User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);

        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS,
            User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS
        ]);

        $actionCreated = Action::factory()->create(['user_id'=>$user->id]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/action/$actionCreated->id");

        $response->assertNoContent();
        $this->assertTrue(empty(Action::find($actionCreated->id)));
    }

    public function test_route_action_destroy_is_working_and_event_is_started()
    {
        Permission::create(['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]);
        Permission::create(['name' => User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]);

        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS,
            User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS
        ]);

        $actionCreated = Action::factory()->create(['user_id'=>$user->id]);
        Sanctum::actingAs(
            $user,
        );

        Event::fake();
        $response = $this->deleteJson("/api/v1/action/$actionCreated->id");

        $response->assertNoContent();
        $this->assertTrue(empty(Action::find($actionCreated->id)));
        Event::assertDispatchedTimes(BookCanBeBookedEvent::class);
    }
}
