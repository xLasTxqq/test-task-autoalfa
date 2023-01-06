<?php

namespace Tests\Feature\Api\v1\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DestroyCommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_comment_destroy_is_not_working_without_auth()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            [],
            'web'
        );
        $commentCreated = Comment::factory()->create();
        Auth::guard('web')->logout();

        $response = $this->deleteJson("/api/v1/comment/$commentCreated->id");

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_comment_destroy_is_not_working_without_permissions()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $commentCreated = Comment::factory()->create();
        $response = $this->deleteJson("/api/v1/comment/$commentCreated->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_comment_destroy_is_not_working_with_false_id()
    {
        Permission::create(['name' => User::PERMISSION_COMMENT_AND_RATE_BOOKS]);
        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_COMMENT_AND_RATE_BOOKS,
        ]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/comment/0");

        $response->assertStatus(404);
    }

    public function test_route_comment_destroy_is_working()
    {
        Permission::create(['name' => User::PERMISSION_COMMENT_AND_RATE_BOOKS]);

        $user = User::factory()->create();

        $user->givePermissionTo([
            User::PERMISSION_COMMENT_AND_RATE_BOOKS,
        ]);
        Sanctum::actingAs(
            $user,
        );
        $commentCreated = Comment::factory()->create();
        $response = $this->deleteJson("/api/v1/comment/$commentCreated->id");

        $response->assertNoContent();
        $this->assertEmpty(Comment::find($commentCreated->id));
    }
}
