<?php

namespace Tests\Feature\Api\v1\Genre;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DestroyGenreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_genre_destroy_is_not_working_without_auth()
    {
        $createdGenre = Genre::factory()->create();
        $response = $this->deleteJson("/api/v1/genre/$createdGenre->id");

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_genre_destroy_is_not_working_without_permissions()
    {
        $createdGenre = Genre::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->deleteJson("/api/v1/genre/$createdGenre->id");

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_genre_destroy_is_not_working_with_false_id()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);
        $user = User::factory()->create();
        $user->givePermissionTo([
            User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS,
        ]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->deleteJson("/api/v1/genre/0");

        $response->assertStatus(404);
    }

    public function test_route_genre_destroy_is_working()
    {
        Permission::create(['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        $user = User::factory()->create();

        $user->givePermissionTo([
            User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS,
        ]);

        $createdGenre = Genre::factory()->create();
        Sanctum::actingAs(
            $user,
        );
        $response = $this->deleteJson("/api/v1/genre/$createdGenre->id");

        $response->assertNoContent();
        $this->assertEmpty(Genre::find($createdGenre->id));
    }
}
