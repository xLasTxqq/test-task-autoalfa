<?php

namespace Tests\Feature\Api\v1\Role;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoleRoutesTest extends TestCase
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
    public function test_route_role_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/api/v1/role');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_role_index_is_working_without_auth()
    {
        $response = $this->getJson('/api/v1/role');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
