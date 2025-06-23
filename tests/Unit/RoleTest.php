<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_creer_un_role()
    {
        // 👷 Création du rôle
        $role = Role::create([
            'name' => 'editeur',
        ]);

        // ✅ Vérifie que le rôle existe bien en base
        $this->assertDatabaseHas('roles', [
            'name' => 'editeur',
        ]);

        // ✅ Vérifie que c’est bien une instance de Role
        $this->assertInstanceOf(Role::class, $role);

        // ✅ Vérifie que l’attribut est bien assigné
        $this->assertEquals('editeur', $role->name);
    }
}
