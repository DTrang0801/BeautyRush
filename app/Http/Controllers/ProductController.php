<?php

namespace App\Http\Controllers;

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

        return view('product', ['products' => $products]);
    }
}
