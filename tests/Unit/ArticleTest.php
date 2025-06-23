<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    //** @test article validé ou non (is_approved) dans Laravel.
    public function creation_article_non_valide_complet()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $article = Article::create([
            'title' => 'Article test',
            'slug' => 'article-test',
            'content' => 'Contenu test',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'is_approved' => false,
            'keywords' => 'test, blog, osez',
            'image' => 'image-test.jpg',
        ]);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertFalse($article->is_approved);
        $this->assertEquals('test, blog, osez', $article->keywords);
        $this->assertEquals('image-test.jpg', $article->image);
    }

    /** @test */
    public function creation_article_valide_complet()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $article = Article::create([
            'title' => 'Article validé',
            'slug' => 'article-valide',
            'content' => 'Contenu validé',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'is_approved' => true,
            'keywords' => 'valide, blog, osez',
            'image' => 'valide-image.jpg',
        ]);

        $this->assertTrue($article->is_approved);
        $this->assertEquals('valide, blog, osez', $article->keywords);
    }
}
