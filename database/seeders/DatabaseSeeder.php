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
        Post::factory(10)->create();
        // Category::factory(6)->create();
        Category::create([
            'name' => 'Software Engineering'
        ]);
        Category::create([
            'name' => 'Web App'
        ]);
        Category::create([
            'name' => 'Mobile App'
        ]);
        Category::create([
            'name' => 'UI & UX'
        ]);
        Category::create([
            'name' => 'Desktop App'
        ]);
        Saved::factory(5)->create();
    }
}
