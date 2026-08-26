<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        Category::factory(4)->create();
        Article::factory(20)->create();

        $users->first()->reviews()->createMany([
            [
                'product_name' => 'Soft Glow Foundation',
                'rating' => 4.9,
                'content' => 'Feels weightless and still looks fresh at the end of the day.',
            ],
            [
                'product_name' => 'Petal Pop Blush',
                'rating' => 4.8,
                'content' => 'The perfect pink for a quick, polished look.',
            ],
        ]);

    }
}
