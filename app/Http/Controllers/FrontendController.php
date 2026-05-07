<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Get unique categories for the filter dropdown and include JobYaari standard categories
        $dbCategories = Blog::select('category')->distinct()->pluck('category')->toArray();
        $standard = ['Admit Cards', 'Results', 'Latest Jobs', 'Government Jobs', 'Internships'];
        $categories = collect(array_values(array_unique(array_merge($standard, $dbCategories))));

        // Featured posts for the homepage (kept separate from AJAX listing)
        $featured = Blog::latest()->take(3)->get();

        return view('frontend.index', compact('categories', 'featured'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('frontend.show', compact('blog'));
    }
}
