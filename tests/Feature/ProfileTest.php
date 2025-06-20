<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this
            ->actingAs($user)
            ->get('/editeur/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this
            ->actingAs($user)
            ->patch('/editeur/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/editeur/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this
            ->actingAs($user)
            ->patch('/editeur/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/editeur/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create(['role_id' => 2]);

        $response = $this
            ->actingAs($user)
            ->delete('/editeur/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        // ✅ Créer un utilisateur avec un mot de passe connu
        $user = User::factory()->create([
            'password' => bcrypt('secret'),
            'role_id' => 2 // 2 = éditeur
        ]);

        // ❌ Tenter de supprimer avec un mauvais mot de passe
        $response = $this
            ->actingAs($user)
            ->from('/editeur/profile')
            ->delete('/editeur/profile', [
                'password' => 'wrong-password',
            ]);

        // ✅ Attente d'une erreur de validation
        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/editeur/profile');

        // ✅ Vérifie que l'utilisateur existe encore
        $this->assertNotNull($user->fresh());
    }
}
