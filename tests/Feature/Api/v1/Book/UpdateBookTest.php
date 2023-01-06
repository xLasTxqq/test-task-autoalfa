<?php

namespace Tests\Feature\Api\v1\Book;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateBookTest extends TestCase
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
    public function test_route_book_update_is_not_working_without_auth()
    {
        $bookCreated = Book::factory()->create();
        $bookUpdate = Book::factory()->create()->toArray();

        $response = $this->putJson("/api/v1/book/$bookCreated->id", $bookUpdate);

        $response->assertStatus(401)
            ->assertJson(['message' => "Unauthenticated."]);
    }

    public function test_route_book_update_is_not_working_without_permissions()
    {
        $bookCreated = Book::factory()->create();
        $bookUpdate = Book::factory()->create()->toArray();

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->putJson("/api/v1/book/$bookCreated->id", $bookUpdate);

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);
    }

    public function test_route_book_update_is_not_working_with_false_id()
    {
        $bookUpdate = Book::factory()->create()->toArray();

        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->putJson("/api/v1/book/0", $bookUpdate);

        $response->assertStatus(404);
    }

    public function test_route_book_update_is_working()
    {
        $bookCreated = Book::factory()->create();
        $bookUpdate = Book::factory()->create()->toArray();

        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->putJson("/api/v1/book/$bookCreated->id", $bookUpdate);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_book_update_is_not_working_without_validate()
    {
        $bookCreated = Book::factory()->create();

        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]);

        Sanctum::actingAs(
            $user,
        );

        $response = $this->putJson("/api/v1/book/$bookCreated->id");

        $response->assertStatus(422)
            ->assertJsonStructure(['errors' => []]);
    }
}
