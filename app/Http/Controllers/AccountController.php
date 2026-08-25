<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $reviews = [
            [
                'product' => 'Soft Glow Foundation',
                'rating' => '4.9/5',
                'text' => 'Feels weightless and still looks fresh at the end of the day.',
            ],
            [
                'product' => 'Petal Pop Blush',
                'rating' => '4.8/5',
                'text' => 'The perfect pink for a quick, polished look.',
            ],
        ];

        $tips = [
            [
                'title' => 'Keep your base fresh',
                'text' => 'Apply foundation in thin layers and let each layer settle before adding more.',
            ],
            [
                'title' => 'Make blush last longer',
                'text' => 'Tap a little cream blush underneath powder blush for a soft, lasting flush.',
            ],
        ];

        return view('account', compact('reviews', 'tips'));
    }
}
