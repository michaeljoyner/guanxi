<?php

namespace App\Http\Controllers;

use App\Content\Article;
use App\Content\ArticlesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticlesController extends Controller
{

    public function index(ArticlesRepository $repository)
    {
        $articles = $repository->paginatedArticles();

        return view('front.articles.index')->with(compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('front.articles.page')->with(compact('article'));
    }
}
