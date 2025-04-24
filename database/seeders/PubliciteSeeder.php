<?php

namespace Database\Seeders;

use App\Models\Publicite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PubliciteSeeder extends Seeder
{
    public function run(): void
    {
        Publicite::create([
            'titre' => 'Un billet pour Cannes !',
            'lien' => 'https://monsite.com/cookies',
            'image' => 'publicites/cinema.jpg',
            'is_active' => true,
            'date_debut' => now()->subDays(5),
            'date_fin' => now()->addDays(5),
        ]);

        Publicite::create([
            'titre' => 'Club de yoga pour tous',
            'lien' => 'https://www.yogaflowcannes.com/r',
            'image' => 'publicites/yoga.jpg',
            'is_active' => true,
            'date_debut' => now()->subDays(2),
            'date_fin' => now()->addWeek(),
        ]);

        Publicite::create([
            'titre' => 'Participez à notre randonnée mensuelle',
            'lien' => 'https://www.ffrandonnee.fr/adherer/randopass/le-randopass-pour-tous-les-amoureux-de-la-rando',
            'image' => 'publicites/randonnées.jpg',
            'is_active' => true,
            'date_debut' => now()->subDay(),
            'date_fin' => now()->addDays(3),
        ]);

        Publicite::create([
            'titre' => 'Voyage entre amis',
            'lien' => 'https://www.lesaventureurs.com/explorer/voyager-en-groupe?utm_source=google&date=0705&code=70eafe06&utm_medium=cpc+sem&gad_source=1&gbraid=0AAAAADGaPqagTlk5JA8Ue_QLkpU6u2vgt&gclid=CjwKCAjwwqfABhBcEiwAZJjC3hSOpxdPJFe9QMnOL0iJ9cYcNdiygBbzMRG8IE9ecVjd4U-HWqWR4xoCLaMQAvD_BwE',
            'image' => 'publicites/voyage.webp',
            'is_active' => true,
            'date_debut' => now()->subDay(),
            'date_fin' => now()->addDays(3),
        ]);
        Publicite::create([
            'titre' => 'Cours informatique',
            'lien' => 'https://laplateforme.io/',
            'image' => 'publicites/info.jpeg',
            'is_active' => true,
            'date_debut' => now()->subDay(),
            'date_fin' => now()->addDays(3),
        ]);
        Publicite::create([
            'titre' => 'Les pieds sur terre',
            'lien' => 'https://www.radiofrance.fr/franceculture/podcasts/les-pieds-sur-terre',
            'image' => 'publicites/podcast.jpg',
            'is_active' => true,
            'date_debut' => now()->subDay(),
            'date_fin' => now()->addDays(3),
        ]);
    }
}
