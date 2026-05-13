<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Seed the application's blog categories.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Research Insights'],
            ['name' => 'Digital Safety'],
            ['name' => 'Community'],
            ['name' => 'News'],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
