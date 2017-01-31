<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Content\ArticlesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeaturedArticleController extends Controller
{

    public function show(ArticlesRepository $articlesRepository)
    {
        $article = $articlesRepository->getFeaturedArticle();
        return response()->json([
            'id' => $article->id,
            'title' => $article->title
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, ['feature' => 'required|boolean']);

        $new_state = $request->feature ? $article->feature() : $article->unfeature();

        return response()->json(compact('new_state'));
    }
}
