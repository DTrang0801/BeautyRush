<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $tips = Tip::latest()
            ->take(3)
            ->get()
            ->map(fn (Tip $tip): array => [
                'title' => $tip->title,
                'text' => $tip->content,
            ])
            ->all();

        if ($tips === []) {
            $tips = [
                [
                    'title' => 'Keep your base fresh',
                    'text' => 'Apply foundation in thin layers and let each layer settle before adding more.',
                ],
                [
                    'title' => 'Make blush last longer',
                    'text' => 'Tap a little cream blush underneath powder blush for a soft, lasting flush.',
                ],
                [
                    'title' => 'Blend concealer naturally',
                    'text' => 'Use a small amount and tap the edges with your ring finger for a seamless finish.',
                ],
            ];
        }

        return view('welcome', [
            'products' => config('products'),
            'tips' => $tips,
        ]);
    }
}
