<?php

namespace Tests\Feature\Api\v1\Subscriber;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroySubscriberTest extends TestCase
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
    public function test_route_subscriber_destroy_is_working()
    {
        $user = User::factory()->create();
        $createdSubscriber = Subscriber::factory()->create(['user_id'=>$user->id]);     

        $user->givePermissionTo([User::PERMISSION_SUBSCRIBE_TO_BOOKS]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/subscriber/$createdSubscriber->id");

        $response->assertNoContent();
    }

    public function test_route_subscriber_destroy_is_not_working_without_auth()
    {
        $createdSubscriber = Subscriber::factory()->create();
        $response = $this->deleteJson("/api/v1/subscriber/$createdSubscriber->id");

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_subscriber_destroy_is_not_working_without_permissions()
    {
        $user = User::factory()->create();
        $createdSubscriber = Subscriber::factory()->create(['user_id'=>$user->id]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/subscriber/$createdSubscriber->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_subscriber_destroy_is_not_working_with_false_id()
    {
        $user = User::factory()->create();
        $createdSubscriber = Subscriber::factory()->create(['user_id'=>$user->id]);

        $user->givePermissionTo([User::PERMISSION_SUBSCRIBE_TO_BOOKS]);
        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/subscriber/0");

        $response->assertStatus(404);
    }
}
