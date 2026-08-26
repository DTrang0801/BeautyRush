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
            ['title' => 'Use primer where you need it', 'content' => 'Apply primer only to areas where makeup fades or texture needs smoothing.'],
            ['title' => 'Warm up cream products', 'content' => 'Warm cream blush or bronzer on the back of your hand before applying it for a softer finish.'],
            ['title' => 'Apply mascara from the roots', 'content' => 'Wiggle the wand at the roots before pulling it through the lashes for extra lift.'],
            ['title' => 'Keep lips hydrated', 'content' => 'Use a lip balm before lipstick and gently remove any excess before applying color.'],
            ['title' => 'Find your best natural light', 'content' => 'Check your makeup near a window to see how the colors really look before heading out.'],
            ['title' => 'Layer skincare lightly', 'content' => 'Apply the thinnest products first and allow each layer to absorb before adding the next.'],
            ['title' => 'Use less powder', 'content' => 'Set only the areas that need it to keep the rest of your skin looking fresh and natural.'],
            ['title' => 'Refresh makeup with mist', 'content' => 'A light setting mist can bring back a comfortable glow when makeup starts to look dry.'],
            ['title' => 'Match blush to your lips', 'content' => 'Choosing blush and lip colors from the same color family creates an effortless, balanced look.'],
            ['title' => 'Curl lashes before mascara', 'content' => 'Curl clean lashes before applying mascara to help open up the eyes without clumps.'],
            ['title' => 'Tap, do not drag concealer', 'content' => 'Gently tapping concealer into the skin gives better coverage and keeps the base smooth.'],
            ['title' => 'Clean your phone screen', 'content' => 'Wiping your phone regularly can help keep makeup and excess oil away from your skin.'],
            ['title' => 'Use a clean spoolie', 'content' => 'A clean spoolie can soften brow pencil and separate lashes for a more natural finish.'],
            ['title' => 'Give your skin a makeup break', 'content' => 'Taking makeup-free days can make your routine feel more comfortable and intentional.'],
            ['title' => 'Apply highlighter sparingly', 'content' => 'Place a small amount on the high points of the face for a soft glow instead of glitter everywhere.'],
            ['title' => 'Store products away from heat', 'content' => 'Keep makeup and skincare in a cool, dry place to help protect their texture and quality.'],
            ['title' => 'Remove makeup before bed', 'content' => 'A gentle, complete cleanse at night gives your skin a clean start for your evening routine.'],
        ];

        collect($additionalTips)->each(function (array $tip, int $index) use ($users): void {
            $user = $users->get(1 + ($index % ($users->count() - 1)));
            $user->tips()->create($tip);
        });

    }
}
