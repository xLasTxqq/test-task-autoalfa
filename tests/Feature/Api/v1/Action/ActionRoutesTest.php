<?php

namespace Tests\Feature\Api\v1\Action;

use App\Models\Action;
use App\Models\Book;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Tests\TestCase;

class ActionRoutesTest extends TestCase
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
    public function test_route_action_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/api/v1/action');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_action_create_is_working()
    {

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/v1/action', Action::factory()->create()->toArray());

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }

    public function test_route_action_update_is_working()
    {
        $action = Action::factory()->create();
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $response = $this->putJson('/api/v1/action/' . $action->id, $action->toArray());

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $action->id);
    }

    public function test_route_action_destroy_is_working()
    {
        $user = User::factory()->create();
        // $user->givePermissionTo('give_and_take_books');
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $action = Action::factory()->create([
            'user_id'=>$user->id,
            'status_id'=>1
        ]);
        $response = $this->deleteJson('/api/v1/action/' . $action->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $action->id);
    }

    public function test_route_action_index_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/action');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_create_is_not_working_without_auth()
    {

        $response = $this->postJson('/api/v1/action', Action::factory()->create()->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_update_is_not_working_without_auth()
    {
        $action = Action::factory()->create();

        $response = $this->putJson('/api/v1/action/' . $action->id, $action->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_action_destroy_is_not_working_without_auth()
    {
        $action = Action::factory()->create();
        $response = $this->deleteJson('/api/v1/action/' . $action->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
