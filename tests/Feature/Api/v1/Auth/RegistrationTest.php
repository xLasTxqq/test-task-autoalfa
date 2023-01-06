<?php

namespace Tests\Feature\Auth;

use App\Events\PasswordCreatedOrUpdatedEvent;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function test_guest_users_can_not_register()
    {
        Mail::fake();
        Event::fake();
        $email = 'test@example.com';

        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => random_int(1, 3)
        ]);

        $response->assertStatus(401);
        $this->assertGuest();
        Event::assertNotDispatched(PasswordCreatedOrUpdatedEvent::class);
    }

    public function test_users_can_register_with_permissions()
    {
        Mail::fake();
        Event::fake();
        $email = 'test@example.com';

        $user = User::factory()->create();

        $user->givePermissionTo([User::PERMISSION_CREATE_DELETE_USERS]);

        Sanctum::actingAs(
            $user
        );

        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => random_int(1, 3)
        ]);

        $response->assertNoContent();
        $this->assertAuthenticated();
        Event::assertDispatchedTimes(PasswordCreatedOrUpdatedEvent::class);
    }

    public function test_users_can_not_register_without_permissions()
    {
        Mail::fake();
        Event::fake();
        $email = 'test@example.com';

        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => random_int(1, 3)
        ]);

        $response->assertStatus(403)
            ->assertJson(['message' => "User does not have the right permissions."]);;
        $this->assertAuthenticated();
        Event::assertNotDispatched(PasswordCreatedOrUpdatedEvent::class);
    }
}
