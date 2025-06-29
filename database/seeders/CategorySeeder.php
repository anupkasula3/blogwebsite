<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Latest tech news, reviews, and insights from the digital world.',
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'description' => 'Business strategies, entrepreneurship, and market insights.',
                'is_active' => true,
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Health, wellness, travel, and personal development articles.',
                'is_active' => true,
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Movies, music, TV shows, and celebrity news.',
                'is_active' => true,
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports news, analysis, and updates from around the world.',
                'is_active' => true,
            ],
            [
                'name' => 'Science',
                'description' => 'Scientific discoveries, research, and educational content.',
                'is_active' => true,
            ],
            [
                'name' => 'Education',
                'description' => 'Learning resources, tutorials, and educational insights.',
                'is_active' => true,
            ],
            [
                'name' => 'Food & Cooking',
                'description' => 'Recipes, cooking tips, and food culture articles.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => $category['is_active'],
            ]);
        }
    }
}
