<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Sylvie',
            'email' => 'Sosylvie1@gmail.com',
            'password' => Hash::make('MamieSylvie123'),
            'role_id' => 'admin',
        ]);

        // Éditeur
        User::create([
            'name' => 'Pierre',
            'email' => 'pierre.andrejko@laplateforme.io',
            'password' => Hash::make('Editeur123'),
            'role_id' => 'editeur',
        ]);
        // Éditeur
        User::create([
            'name' => 'Prasanna',
            'email' => 'prasanna.darbha@laplateforme.io',
            'password' => Hash::make('Editeur123'),
            'role_id' => 'editeur',
        ]);


        // Autre utilisateur simple
        User::create([
            'name' => 'Stéphane',
            'email' => 'stephane.haluszczak@laplateforme.io',
            'password' => Hash::make('Editeur123'),
            'role_id' => 'user',
        ]);
    }
}


