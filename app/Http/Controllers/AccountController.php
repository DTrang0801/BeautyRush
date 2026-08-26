<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Tip;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $reviews = Auth::check()
            ? Auth::user()->reviews()->latest()->get()->map(fn (Review $review): array => [
                'id' => $review->id,
                'editable' => true,
                'product' => $review->product_name,
                'rating' => $review->rating.'/5',
                'text' => $review->content,
            ])
            : collect();

        $tips = [];

        $myTips = Auth::check()
            ? Auth::user()->tips()->latest()->get()
            : collect();
        $favoriteTipIds = collect(session('favorite_tips', []))
            ->filter(fn (string $key): bool => str_starts_with($key, 'tip-'))
            ->map(fn (string $key): string => str_replace('tip-', '', $key))
            ->values();
        $savedTips = Tip::query()
            ->whereIn('id', $favoriteTipIds)
            ->latest()
            ->get()
            ->map(fn (Tip $tip): array => [
                'title' => $tip->title,
                'text' => $tip->content,
                'key' => 'tip-'.$tip->id,
            ])
            ->all();
        $favoriteProductNames = collect(session('favorite_products', []));
        $savedProducts = collect(config('products'))
            ->filter(fn (array $product): bool => $favoriteProductNames->contains($product['name']))
            ->values();
        $communityTips = collect($tips)->concat($myTips->map(fn ($tip) => [
            'id' => $tip->id,
            'editable' => true,
            'author' => Auth::user()->name,
            'title' => $tip->title,
            'text' => $tip->content,
        ]));

        return view('account', compact('reviews', 'tips', 'savedTips', 'savedProducts', 'communityTips'));
    }
}
