<?php

namespace App\Http\Controllers;

use App\Models\Review;
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
            $product['reviews'] = Review::with('user')
                ->where('product_name', $product['name'])
                ->latest()
                ->get()
                ->map(fn (Review $review): array => [
                    'reviewer' => $review->user->name,
                    'rating' => $review->rating.'/5',
                    'text' => $review->content,
                ])
                ->concat([
                    ['reviewer' => $product['reviewer'], 'rating' => $product['rating'], 'text' => $product['review']],
                    ['reviewer' => 'Mila P.', 'rating' => '4.8/5', 'text' => 'A lovely product that is easy to use and has become part of my routine.'],
                    ['reviewer' => 'Noor B.', 'rating' => '4.7/5', 'text' => 'The quality is beautiful and the result feels effortless.'],
                ])
                ->values()
                ->all();

            return $product;
        })->all();

        return view('product', [
            'products' => $products,
            'favoriteProducts' => session('favorite_products', []),
        ]);
    }

    public function toggleFavorite(Request $request, string $product): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('status', 'Please log in to save a product.');
        }

        abort_unless(collect(config('products'))->contains('name', $product), 404);
        $favorites = $request->session()->get('favorite_products', []);

        if (in_array($product, $favorites, true)) {
            $favorites = array_values(array_diff($favorites, [$product]));
        } else {
            $favorites[] = $product;
        }

        $request->session()->put('favorite_products', $favorites);

        return back();
    }
}
