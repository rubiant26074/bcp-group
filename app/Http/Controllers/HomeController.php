<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::with('category')->latest()->take(6)->get();
        $latestArticles = Article::latest('published_at')->take(3)->get();

        return view('pages.home', compact('sliders', 'categories', 'featuredProducts', 'latestArticles'));
    }
}
