<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleBannerFeatureController extends Controller
{
    public function store()
    {
        $article = Article::findOrFail(request('article_id'));

        return $article->feature();
    }
}
