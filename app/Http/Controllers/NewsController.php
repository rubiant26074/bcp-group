<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class NewsController extends Controller
{
    public function index()
    {
        $articles = Article::latest('published_at')->paginate(9);
        return view('pages.news.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $recentArticles = Article::where('id', '!=', $article->id)->take(5)->get();

        return view('pages.news.show', compact('article', 'recentArticles'));
    }
}
