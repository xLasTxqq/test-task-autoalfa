<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    // public function test_reset_password_link_screen_can_be_rendered()
    // { 
    //     $response = $this->get('/forgot-password');

    //     $response->assertStatus(200);
    // }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/api/v1/forgot-password', ['email' => $user->email]);

        $response->assertJson(fn (AssertableJson $json) => $json->has('status'));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    // public function test_reset_password_screen_can_be_rendered()
    // {
    //     Notification::fake();

    //     $user = User::factory()->create();

    //     $this->postJson('/api/v1/forgot-password', ['email' => $user->email]);

    //     Notification::assertSentTo($user, ResetPassword::class, function ($notification) {

    //         $response = $this->getJson('/api/v1/reset-password/'.$notification->token);

    //         $response->assertStatus(200);

    //         return true;
    //     });
    // }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/api/v1/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/api/v1/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            // $response->assertSessionHasNoErrors();
            $response->assertJson(fn (AssertableJson $json) => $json->has('status'));

            return true;
        });
    }
}
