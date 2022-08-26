<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        // Category::factory(6)->create();
        Category::create([
            'name' => 'Software Engineering',
            'slug' => 'software-engineering'
        ]);
        Category::create([
            'name' => 'Web App',
            'slug' => 'web-app'
        ]);
        Category::create([
            'name' => 'Mobile App',
            'slug' => 'mobile-app'
        ]);
        Category::create([
            'name' => 'UI & UX',
            'slug' => 'ui-&-ux'
        ]);
        Category::create([
            'name' => 'Desktop App',
            'slug' => 'desktop-app'
        ]);
        Post::factory(10)->create();
        // Saved::factory(5)->create();
    }
}
