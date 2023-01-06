<?php

namespace Tests\Feature\Api\v1\Grade;

use App\Models\Book;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GradeRoutesTest extends TestCase
{
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
    public function test_route_grade_store_is_working()
    {
        $book = Book::factory()->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->postJson('/api/v1/grade', ['stars' => random_int(1, 10), 'book_id' => $book->id]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_grade_destroy_is_working()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $grade = Grade::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/v1/grade/' . $grade->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $grade->id)
            ->assertJsonPath('data.name', $grade->name);
    }

    public function test_route_grade_store_is_not_working_without_auth()
    {
        $book = Book::factory()->create();
        $response = $this->postJson('/api/v1/grade', ['stars' => random_int(1, 10), 'book_id' => $book->id]);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_grade_destroy_is_not_working_without_auth()
    {
        $user = User::factory()->create();
        $grade = Grade::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/v1/grade/' . $grade->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
