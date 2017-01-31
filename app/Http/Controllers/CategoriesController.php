<?php

namespace App\Http\Controllers;

use App\Content\ArticlesRepository;
use App\Content\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function show($slug, ArticlesRepository $repository)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = $repository->paginatedCategoryArticles($category);

        return view('front.articles.category')->with(compact('articles', 'category'));
    }
}
