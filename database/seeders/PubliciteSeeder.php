<?php

namespace Database\Seeders;

use App\Models\Publicite;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PubliciteSeeder extends Seeder
{
    public function run(): void
    {
        // Récupère un utilisateur existant (éditeur)
        $user = User::where('role_id', 2)->first(); // 2 = rôle éditeur par convention

        if (!$user) {
            echo "⚠️ Aucun éditeur trouvé. Seeder annulé.\n";
            return;
        }

        Publicite::create([
            'titre' => 'Découvrez nos astuces bien-être !',
            'lien' => 'https://bienetre.example.com',
            'image' => 'publicites/astuces-bien-etre.jpg',
            'is_approved' => true,
                'paid' => true,
                'paid_at' => now()->subDays(rand(1, 10)),
                'date_debut' => now()->subDays(rand(1, 5)),
                'date_fin' => Carbon::now()->addDays(30),
                'user_id' => $user->id,

        ]);

        Publicite::create([
            'titre' => 'Coaching de carrière personnalisé',
            'lien' => 'https://coaching.example.com',
            'image' => 'publicites/coaching-carriere.jpg',
            'is_approved' => true,
                'paid' => true,
                'paid_at' => now()->subDays(rand(1, 10)),
                'date_debut' => now()->subDays(rand(1, 5)),
                'date_fin' => Carbon::now()->addDays(30),
                'user_id' => $user->id,

        ]);
        Publicite::create([
            'titre' => ' Coaching de carrière personnalisé',
            'lien' => 'https://coaching.example.com',
            'image' => 'publicites/coaching-carriere.jpg',
            'is_approved' => true,
                'paid' => true,
                'paid_at' => now()->subDays(rand(1, 10)),
                'date_debut' => now()->subDays(rand(1, 5)),
                'date_fin' => Carbon::now()->addDays(30),
                'user_id' => $user->id,

        ]);
        Publicite::create([
            'titre' => '💼 Coaching de carrière personnalisé',
            'lien' => 'https://coaching.example.com',
            'image' => 'publicites/coaching-carriere.jpg',
            'is_approved' => true,
                'paid' => true,
                'paid_at' => now()->subDays(rand(1, 10)),
                'date_debut' => now()->subDays(rand(1, 5)),
                'date_fin' => Carbon::now()->addDays(30),
                'user_id' => $user->id,

        ]);
    }
}
