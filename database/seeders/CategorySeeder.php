<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Travail', 'color_class' => 'bg-yellow-500 text-white'],
            ['id' => 2, 'name' => 'École', 'color_class' => 'bg-blue-500 text-white'],
            ['id' => 3, 'name' => 'Famille', 'color_class' => 'bg-pink-500 text-white'],
            ['id' => 4, 'name' => 'Couple', 'color_class' => 'bg-red-500 text-white'],
            ['id' => 5, 'name' => 'Société', 'color_class' => 'bg-green-500 text-white'],
            ['id' => 6, 'name' => 'Développement Personnel', 'color_class' => 'bg-purple-600 text-white'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'id' => $category['id'],
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'color_class' => $category['color_class'],
            ]);
        }
    }
}
