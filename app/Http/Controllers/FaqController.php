<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('faq', ['categories' => Category::with('faqs')->orderBy('name')->get()]);
    }
}
