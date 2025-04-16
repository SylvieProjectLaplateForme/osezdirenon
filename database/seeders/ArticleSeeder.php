<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer toutes les catégories existantes
        $categories = Category::all();

        // ===== Article 1 =====
        Article::create([
            
                'title' => "Osez dire non… au travail",
                'slug' => Str::slug("osez-dire-non-au-travail") . '-' . uniqid(),
                'content' => "
                    <p>Dire non au travail peut sembler impensable. Pourtant, poser des limites est essentiel pour préserver sa santé mentale.</p>
                    <p>Refuser une charge supplémentaire lorsqu’on est déjà débordé n’est pas un signe de faiblesse, c’est une preuve de lucidité. Trop de burn-out naissent du silence.</p>
                    <p class='italic text-red-600'>Osez dire non, c’est dire oui à votre équilibre.</p>
                ",
                'category_id' => 1,
                'keywords' => 'travail, burn-out, limites, respect',
                'image' => 'non-travail.jpg',
            ]);
            
       

        // ===== Article 2 =====
        Article::create([
            
                'title' => "Osez dire non… à l’école",
                'slug' => Str::slug("osez-dire-non-a-lecole") . '-' . uniqid(),
                'content' => "
                    <p>À l’école, on apprend à obéir, à suivre les règles. Mais quand une règle est injuste, faut-il la suivre aveuglément ?</p>
                    <p>Les élèves ont le droit d’exprimer un désaccord, de refuser une humiliation, de dire non à une injustice ou au harcèlement.</p>
                    <p class='italic text-red-600'>L’éducation passe aussi par l’affirmation de soi.</p>
                ",
                'category_id' => 2,
                'keywords' => 'école, harcèlement, élèves, expression',
                'image' => 'ecole-non.jpg',
            ]);
            

        // Article 3 
        Article::create([
            'title' => "Osez dire non… en famille",
            'slug' => Str::slug("osez-dire-non-en-famille") . '-' . uniqid(),
            'content' => "
                <p>Les liens familiaux sont précieux. Mais ils ne justifient pas tout. On peut aimer sa famille et poser des limites.</p>
                <p>Un non peut préserver une relation. Un non peut éviter une explosion. Un non peut être un acte d’amour de soi.</p>
                <p class='italic text-red-600'>Dire non à un parent, ce n’est pas le rejeter. C’est se respecter.</p>
            ",
            'category_id' => 3,
            'keywords' => 'famille, limites, respect, autonomie',
            'image' => 'famille-non.jpg',
        ]);
        

        
        // Crée l'article 4
        Article::create([
            'title' => "Osez dire non… dans le couple",
    'slug' => Str::slug("osez-dire-non-dans-le-couple") . '-' . uniqid(),
    'content' => "
        <p>Dans un couple, dire non est vital. L’amour ne doit jamais effacer l’identité.</p>
        <p>Un partenaire qui aime vraiment respecte le non. Il ne l’interprète pas comme une trahison, mais comme un besoin.</p>
        <p class='italic text-red-600'>Oser dire non dans le couple, c’est choisir la relation, pas la soumission.</p>
    ",
    'category_id' => 4,
    'keywords' => 'amour, couple, respect, communication',
    'image' => 'couple-non.png',
]);

 // Crée l'article 5
 Article::create([
    
    'title' => "Osez dire non… à la société",
    'slug' => Str::slug("osez-dire-non-a-la-societe") . '-' . uniqid(),
    'content' => "
        <p>On nous pousse à être productifs, à consommer, à rentrer dans un moule. Et si on disait non ?</p>
        <p>Non à la vitesse, non au conformisme, non aux normes absurdes. Dire non, c’est parfois retrouver sa liberté.</p>
        <p class='italic text-red-600'>Résister, c’est déjà construire autre chose.</p>
    ",
    'category_id' => 5,
    'keywords' => 'société, consommation, résistance, liberté',
    'image' => 'societe-non.jpg',
]);

// Article 6
Article::create([
'title' => "Osez dire non… à soi-même",
'slug' => Str::slug("osez-dire-non-a-soi-meme") . '-' . uniqid(),
'content' => "
    <p>Le plus difficile parfois, c’est de se dire non à soi-même. Non à nos impulsions, à nos automatismes, à nos pensées limitantes.</p>
    <p>Dire non, c’est se discipliner. C’est choisir une voie plus longue, mais plus juste.</p>
    <p class='italic text-red-600'>Se dire non, c’est se respecter profondément.</p>
",
'category_id' => 6,
'keywords' => 'développement personnel, discipline, choix',
'image' => 'soi-meme-non.png',
]);



        // ===== 10 articles d'exemple =====
        foreach (range(1, 10) as $i) {
            Article::create([
                'title' => "Article d'exemple $i",
                'content' => "
                    <p>Ceci est le contenu de l'article numéro $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                ",
                'slug' => Str::slug("article-exemple-$i") . '-' . uniqid(), // Slug unique automatique
                'category_id' => $categories->random()->id,
                'keywords' => 'exemple, blog, article',
                'image' => 'default.jpg', // Tu peux créer une image "default.jpg" si tu veux
            ]);
        }
    }
}
