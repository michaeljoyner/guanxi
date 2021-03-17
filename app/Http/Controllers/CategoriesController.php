<?php

namespace App\Http\Controllers;

use App\Content\ArticlesRepository;
use App\Content\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function show(Category $category, ArticlesRepository $repository)
    {
        $designation = request('designation', '');
        $articles = $repository->withDesignation($designation)->paginatedCategoryArticles($category);

        return view('front.articles.category', [
            'articles' => $articles,
            'category' => $category,
            'designation' => $designation,
        ]);
    }
}
