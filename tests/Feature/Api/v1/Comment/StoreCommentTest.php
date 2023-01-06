<?php

namespace Tests\Feature\Api\v1\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreCommentTest extends TestCase
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
    public function test_route_comment_store_is_working()
    {
        $user = User::factory()->create();
        $user->givePermissionTo([User::PERMISSION_COMMENT_AND_RATE_BOOKS]);
        Sanctum::actingAs(
            $user,
        );
        $response = $this->postJson('/api/v1/comment', Comment::factory()->create()->toArray());

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_comment_store_is_not_working_without_auth()
    {
        $response = $this->postJson('/api/v1/comment', ['text'=>fake()->sentence()]);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_comment_store_is_not_working_without_validate()
    {
        $user = User::factory()->create();
        $user->givePermissionTo([User::PERMISSION_COMMENT_AND_RATE_BOOKS]);
        Sanctum::actingAs(
            $user,
        );
        $response = $this->postJson('/api/v1/comment');

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => []]);
    }

    public function test_route_comment_store_is_not_working_without_permission()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
        );
        $response = $this->postJson('/api/v1/comment', Comment::factory()->create()->toArray());

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }
}
