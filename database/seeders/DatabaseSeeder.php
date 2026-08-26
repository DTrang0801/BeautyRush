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
        Article::factory(20)
            ->state(fn (): array => [
                'category_id' => Category::query()->inRandomOrder()->value('id'),
                'author_id' => User::query()->inRandomOrder()->value('id'),
            ])
            ->create();

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

        $additionalReviews = [
            ['product_name' => 'Velvet Line Mascara', 'rating' => 4.7, 'content' => 'It separates beautifully and lasts through a busy workday.'],
            ['product_name' => 'Rosewood Lip Tint', 'rating' => 4.9, 'content' => 'The color is subtle but lasts surprisingly long without drying my lips.'],
            ['product_name' => 'Cloud Cream Cleanser', 'rating' => 4.8, 'content' => 'My skin feels clean and calm after every wash.'],
            ['product_name' => 'Blush & Blend Brush', 'rating' => 4.6, 'content' => 'It blends quickly and feels lovely on the skin.'],
            ['product_name' => 'Petal Pop Blush', 'rating' => 4.7, 'content' => 'A beautiful everyday shade with a soft finish.'],
        ];

        $users->slice(1, count($additionalReviews))->values()->each(function (User $user, int $index) use ($additionalReviews): void {
            $user->reviews()->create($additionalReviews[$index]);
        });

        $additionalTips = [
            ['title' => 'Prep your skin first', 'content' => 'A light moisturizer helps makeup sit smoothly and look fresh for longer.'],
            ['title' => 'Try blush as eyeshadow', 'content' => 'Use a small amount of your favorite blush on the eyelids for a soft monochromatic look.'],
            ['title' => 'Clean brushes weekly', 'content' => 'Regularly cleaning your brushes helps your makeup apply better and keeps your skin happy.'],
        ];

        $users->slice(1, count($additionalTips))->values()->each(function (User $user, int $index) use ($additionalTips): void {
            $user->tips()->create($additionalTips[$index]);
        });

    }
}
