<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        if (!$user || $categories->isEmpty()) {
            echo "⚠️ Aucun utilisateur ou aucune catégorie trouvée. Seeder annulé.\n";
            return;
        }

        // Article Travail (ID 1)
        Article::create([
            'title' => "Dire non au surmenage au travail",
            'slug' => Str::slug("Dire non au surmenage au travail") . '-' . uniqid(),
            'content' => "
                <p>Apprendre à dire non est essentiel dans un environnement professionnel. Cela permet de préserver sa santé mentale et physique.</p>
                <p>Refuser une tâche supplémentaire, ce n’est pas être paresseux, c’est savoir poser ses limites.</p>
            ",
            'category_id' => 1,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'travail, limites, santé mentale',
            'image' => 'articles/non-travail.jpg',
        ]);

        // Article École (ID 2)
        Article::create([
            'title' => "Dire non au harcèlement scolaire",
            'slug' => Str::slug("Dire non au harcèlement scolaire") . '-' . uniqid(),
            'content' => "
                <p>Refuser d’être complice, c’est déjà agir. Les élèves doivent être éduqués à dire non à la violence et à la discrimination à l’école.</p>
            ",
            'category_id' => 2,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'école, harcèlement, respect',
            'image' => 'articles/ecole-non.jpg',
        ]);

        // Article Famille (ID 3)
        Article::create([
            'title' => "Dire non à la pression familiale",
            'slug' => Str::slug("Dire non à la pression familiale") . '-' . uniqid(),
            'content' => "
                <p>Les choix de vie doivent appartenir à chacun. Dire non à certaines attentes de la famille est un acte d’émancipation.</p>
            ",
            'category_id' => 3,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'famille, pression, autonomie',
            'image' => 'articles/famille-non.webp',
        ]);

        // Article Couple (ID 4)
        Article::create([
            'title' => "Dire non à une relation toxique",
            'slug' => Str::slug("Dire non à une relation toxique") . '-' . uniqid(),
            'content' => "
                <p>Une relation saine repose sur le respect mutuel. Il faut oser dire non quand les limites sont franchies.</p>
            ",
            'category_id' => 4,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'couple, respect, relation toxique',
            'image' => 'articles/couple-non.png',
        ]);

        // Article Société (ID 5)
        Article::create([
            'title' => "Dire non à l'injustice sociale",
            'slug' => Str::slug("Dire non à l'injustice sociale") . '-' . uniqid(),
            'content' => "
                <p>Face aux discriminations, dire non devient un acte citoyen. Chacun peut agir à son échelle pour une société plus juste.</p>
            ",
            'category_id' => 5,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'société, justice, citoyenneté',
            'image' => 'articles/societe-non.jpg',
        ]);

        // Article Développement Personnel (ID 6)
        Article::create([
            'title' => "Dire non pour se développer personnellement",
            'slug' => Str::slug("Dire non pour se développer personnellement") . '-' . uniqid(),
            'content' => "
                <p>Dire non, c’est se dire oui à soi-même. Apprendre à s’écouter et à se respecter est la clé d’un épanouissement durable.</p>
            ",
            'category_id' => 6,
            'user_id' => $user->id,
            'is_approved' => 1,
            'keywords' => 'développement personnel, confiance, estime de soi',
            'image' => 'articles/soi-meme-non.png',
        ]);

        // ===== 10 articles d'exemple =====
        // foreach (range(1, 10) as $i) {
        //     Article::create([
        //         'title' => "Article d'exemple $i",
        //         'slug' => Str::slug("article-exemple-$i") . '-' . uniqid(),
        //         'content' => "
        //             <p>Ceci est le contenu de l'article numéro $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        //         ",
        //         'category_id' => $categories->random()->id,
        //         'user_id' => $user->id,
        //         'is_approved' => 0,
        //         'keywords' => 'exemple, blog, article',
        //         'image' => 'default.jpg',
        //     ]);
        // }
    }
}
