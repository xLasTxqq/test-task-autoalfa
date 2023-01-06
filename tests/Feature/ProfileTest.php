<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    // public function test_profile_page_is_displayed()
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->get('/profile');

    //     $response->assertOk();
    // }

    public function test_profile_information_can_be_updated()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this
            ->patchJson('/api/v1/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response->assertJsonPath('status', true)->assertOk();

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this
            ->patchJson('/api/v1/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response->assertJsonPath('status', true)->assertOk();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this
            ->deleteJson('/api/v1/profile', [
                'password' => 'password',
            ]);

        $response->assertJsonPath('status', true)->assertOk();

        $this->assertGuest('web');
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this
            ->deleteJson('/api/v1/profile', [
                'password' => 'wrong-password',
            ]);

        $response->assertJsonMissingPath('status', true)->assertStatus(422);

        $this->assertNotNull($user->fresh());
    }
}
