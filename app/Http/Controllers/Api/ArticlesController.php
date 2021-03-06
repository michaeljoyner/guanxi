<?php

namespace App\Http\Controllers\Api;

use App\Content\Article;
use App\Content\ArticlesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ArticlesController extends Controller
{
    public function index(Request $request, ArticlesRepository $repository)
    {
        $page = intval($request->page ?? 1);
        $designation = request('designation', '');
        $articles = $repository->withDesignation($designation)->paginatedArticles();

        $html = View::make('front.articles.loader', ['articles' => $articles])->render();

        return response()->json([
            'page' => $page,
            'remaining' => $articles->hasMorePages(),
            'content_html' => $html
        ]);
    }
}
