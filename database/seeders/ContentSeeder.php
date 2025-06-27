<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User; // Assuming you have a User model and might want to create a default user
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Categories
        // Create 5-10 categories
        Category::factory(rand(5, 10))->create()->each(function ($category) {
            $this->command->info("Created category: {$category->title}");
        });
        $this->command->info('Categories seeded!');


        // 2. Create Pages
        // Create 10-20 pages
        Page::factory(rand(10, 20))->create()->each(function ($page) {
            $this->command->info("Created page: {$page->title}");
        });
        $this->command->info('Pages seeded!');


        // 3. Create Posts and attach Categories
        // Create 20-30 posts
        Post::factory(rand(20, 30))->create()->each(function ($post) {
            // Get all existing category IDs
            $categoryIds = Category::pluck('id')->toArray();

            if (!empty($categoryIds)) {
                // Randomly select 1 to 3 categories for each post
                $randomCategoryIds = collect($categoryIds)->random(rand(1, min(3, count($categoryIds))))->toArray();
                $post->categories()->attach($randomCategoryIds);
                $this->command->info("Created post: {$post->title} with categories: " . implode(', ', $randomCategoryIds));
            } else {
                $this->command->warn("Created post: {$post->title} but no categories to attach.");
            }
        });
        $this->command->info('Posts seeded and categories attached!');
    }
}
