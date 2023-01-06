<?php

namespace Tests\Feature\Auth;

use App\Events\PasswordIsReady;
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
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    // public function test_registration_screen_can_be_rendered()
    // {
    //     $response = $this->get('/register');

    //     $response->assertStatus(200);
    // }

    public function test_new_users_can_not_register()
    {
        // Event::fake();
        Mail::fake();
        $email = 'test@example.com';

        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => random_int(1,3)
        ]);

        $response->assertStatus(401);
        $this->assertGuest();
        // Mail::assertSent(NotificationPasswordForm::class, function ($mail) use ($email) {
        //     return $mail->hasTo($email);
        // });
        // Event::assertDispatched(PasswordIsReady::class);
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_admin_can_register()
    {
        Mail::fake();
        Event::fake();
        $email = 'test@example.com';

        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => random_int(1,3)
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticated();
        // Mail::assertSent(NotificationPasswordForm::class, function ($mail) use ($email) {
        //     return $mail->hasTo($email);
        // });
        Event::assertDispatched(PasswordIsReady::class);
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
