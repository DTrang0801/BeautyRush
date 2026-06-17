<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function index()
    {

        // Data laden

        $categories = Category::all();

        // Data doorgeve
        return view('admin.categories.index', [
            'categories' => $categories

        ]);

    }

    public function create()
    {
        return view('admin.categories.create');
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($validated);

        return redirect('/admin/categories');
    }
}