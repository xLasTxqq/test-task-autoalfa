<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated()
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        $response = $this
            ->putJson('/api/v1/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertNoContent();

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_password_can_not_be_updated_without_false_password()
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user
        );

        $response = $this
            ->putJson('/api/v1/password', [
                'current_password' => 'password1',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertStatus(422);

        $this->assertFalse(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_password_can_not_be_updated_without_auth()
    {
        $user = User::factory()->create();

        $response = $this
            ->putJson('/api/v1/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertStatus(401);

        $this->assertFalse(Hash::check('new-password', $user->refresh()->password));
    }

    // public function test_correct_password_must_be_provided_to_update_password()
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         // ->from('/profile')
    //         ->putJson('/password', [
    //             'current_password' => 'wrong-password',
    //             'password' => 'new-password',
    //             'password_confirmation' => 'new-password',
    //         ]);

    //     $response
    //         ->assertSessionHasErrors('current_password');
    // ->assertRedirect('/profile');
    // }
}
