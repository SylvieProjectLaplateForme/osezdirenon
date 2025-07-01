<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Sylvie',
            'email' => 'sosylvie1@gmail.com',
            'password' => Hash::make('passwordadmin'), // ⚡ important :  hache le mot de passe
            'role_id' => 1, // 1 = Admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

