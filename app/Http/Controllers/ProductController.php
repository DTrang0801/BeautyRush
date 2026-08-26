<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
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

        return view('product', [
            'products' => $products,
            'favoriteReviews' => session('favorite_reviews', []),
        ]);
    }

    public function toggleFavoriteReview(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('status', 'Please log in to save a review.');
        }

        $validated = $request->validate([
            'review_key' => ['required', 'string', 'max:255'],
        ]);
        $favorites = $request->session()->get('favorite_reviews', []);

        if (in_array($validated['review_key'], $favorites, true)) {
            $favorites = array_values(array_diff($favorites, [$validated['review_key']]));
        } else {
            $favorites[] = $validated['review_key'];
        }

        $request->session()->put('favorite_reviews', $favorites);

        return back();
    }
}
