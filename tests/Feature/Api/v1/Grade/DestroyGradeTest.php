<?php

namespace Tests\Feature\Api\v1\Grade;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DestroyGradeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_grade_destroy_is_not_working_without_auth()
    {
        $gradeCreated = Grade::factory()->create();
        $response = $this->deleteJson("/api/v1/grade/$gradeCreated->id");

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_grade_destroy_is_not_working_without_permissions()
    {
        $gradeCreated = Grade::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->deleteJson("/api/v1/grade/$gradeCreated->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_grade_destroy_is_not_working_with_false_id()
    {
        Permission::create(['name' => User::PERMISSION_COMMENT_AND_RATE_BOOKS]);
        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_COMMENT_AND_RATE_BOOKS,
        ]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/grade/0");

        $response->assertStatus(404);
    }

    public function test_route_grade_destroy_is_working()
    {
        Permission::create(['name' => User::PERMISSION_COMMENT_AND_RATE_BOOKS]);

        $user = User::factory()->create();

        $user->givePermissionTo([
            User::PERMISSION_COMMENT_AND_RATE_BOOKS,
        ]);

        $gradeCreated = Grade::factory()->create();
        Sanctum::actingAs(
            $user,
        );
        $response = $this->deleteJson("/api/v1/grade/$gradeCreated->id");

        $response->assertNoContent();
        $this->assertEmpty(Grade::find($gradeCreated->id));
    }
}
