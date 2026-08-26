<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $products = collect(config('products'))->map(function (array $product): array {
            $product['details'] = 'A carefully selected Beauty Rush favorite, made to fit beautifully into your everyday routine.';
            $product['reviews'] = [
                ['reviewer' => $product['reviewer'], 'rating' => $product['rating'], 'text' => $product['review']],
                ['reviewer' => 'Mila P.', 'rating' => '4.8/5', 'text' => 'A lovely product that is easy to use and has become part of my routine.'],
                ['reviewer' => 'Noor B.', 'rating' => '4.7/5', 'text' => 'The quality is beautiful and the result feels effortless.'],
            ];

            return $product;
        })->all();

        $tips = Tip::latest()
            ->take(3)
            ->get()
            ->map(fn (Tip $tip): array => [
                'title' => $tip->title,
                'text' => $tip->content,
                'author' => $tip->user->name,
            ])
            ->all();

        if ($tips === []) {
            $tips = [
                [
                    'title' => 'Keep your base fresh',
                    'text' => 'Apply foundation in thin layers and let each layer settle before adding more.',
                    'author' => 'Beauty Rush community',
                ],
                [
                    'title' => 'Make blush last longer',
                    'text' => 'Tap a little cream blush underneath powder blush for a soft, lasting flush.',
                    'author' => 'Beauty Rush community',
                ],
                [
                    'title' => 'Blend concealer naturally',
                    'text' => 'Use a small amount and tap the edges with your ring finger for a seamless finish.',
                    'author' => 'Beauty Rush community',
                ],
            ];
        }

        return view('welcome', [
            'products' => $products,
            'tips' => $tips,
        ]);
    }
}
