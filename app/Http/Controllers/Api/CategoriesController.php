<?php

namespace App\Http\Controllers\Api;

use App\Content\ArticlesRepository;
use App\Content\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    public function index(Category $category, ArticlesRepository $repository)
    {
        $page = intval(request('page', 1));

        $articles = $repository->paginatedCategoryArticles($category);

        $html = View::make('front.articles.loader', ['articles' => $articles])->render();

        return response()->json([
            'page' => $page,
            'remaining' => $articles->hasMorePages(),
            'content_html' => $html
        ]);
    }
}
