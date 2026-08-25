<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $products = [
            [
                'name' => 'Soft Glow Foundation',
                'type' => 'Complexion',
                'description' => 'A breathable, buildable base for a natural everyday glow.',
                'price' => '€29.95',
                'rating' => '4.9/5',
                'review' => 'Feels weightless and still looks fresh at the end of the day.',
                'reviewer' => 'Sophie M.',
                'tone' => 'from-rose-100 to-amber-50',
            ],
            [
                'name' => 'Petal Pop Blush',
                'type' => 'Cheeks',
                'description' => 'A silky blush that melts into the skin for a soft wash of color.',
                'price' => '€18.50',
                'rating' => '4.8/5',
                'review' => 'The perfect pink for a quick, polished look. I use it every day.',
                'reviewer' => 'Nora V.',
                'tone' => 'from-pink-100 to-fuchsia-50',
            ],
            [
                'name' => 'Velvet Line Mascara',
                'type' => 'Eyes',
                'description' => 'A defining mascara that adds volume without clumping or flaking.',
                'price' => '€22.00',
                'rating' => '4.7/5',
                'review' => 'It separates beautifully and lasts through a busy workday.',
                'reviewer' => 'Amelia R.',
                'tone' => 'from-violet-100 to-slate-50',
            ],
        ];

        return view('welcome', compact('products'));
    }
}
