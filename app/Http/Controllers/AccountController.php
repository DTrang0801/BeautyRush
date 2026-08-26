<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        $tips = [];

        $savedTips = [
            [
                'title' => 'A simple evening routine',
                'text' => 'Remove makeup gently, cleanse your skin, and finish with moisturizer before bed.',
            ],
            [
                'title' => 'Blend concealer naturally',
                'text' => 'Use a small amount and tap the edges with your ring finger for a seamless finish.',
            ],
            [
                'title' => 'Refresh your makeup bag',
                'text' => 'Check expiry dates regularly and clean your brushes once a week.',
            ],
        ];

        $myTips = Auth::check()
            ? Auth::user()->tips()->latest()->get()
            : collect();
        $communityTips = collect($tips)->concat($myTips->map(fn ($tip) => [
            'id' => $tip->id,
            'editable' => true,
            'title' => $tip->title,
            'text' => $tip->content,
        ]));

        return view('account', compact('reviews', 'tips', 'savedTips', 'communityTips'));
    }
}
