<?php

namespace App\Http\Controllers\Api;

use App\Content\ArticlesRepository;
use App\Content\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class TagArticlesController extends Controller
{
    public function index($slug, ArticlesRepository $repository)
    {
        $page = request()->get('page', 1);
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $articles = $repository->withTag($tag);

        $html = View::make('front.articles.loader', ['articles' => $articles])->render();

        return response()->json([
            'page' => $page,
            'remaining' => $articles->hasMorePages(),
            'content_html' => $html
        ]);
    }
}
