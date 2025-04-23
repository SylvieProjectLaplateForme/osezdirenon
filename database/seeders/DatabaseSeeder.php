<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // 1. Insérer les rôles
    $this->call([
        RoleSeeder::class,
    ]);

    // 2. Créer un utilisateur admin
    $admin = \App\Models\User::firstOrCreate(
        ['email' => 'sosylvie1@gmail.com'],
        [
            'name' => 'Sylvie',
            'password' => Hash::make('MamieSylvie123'),
            'role_id' => 1, // l’ID du rôle admin
        ]
    );

    // 3. Appeler les autres seeders, après avoir l'utilisateur
    $this->call([
        CategorySeeder::class,
        ArticleSeeder::class,
    ]);
}
}