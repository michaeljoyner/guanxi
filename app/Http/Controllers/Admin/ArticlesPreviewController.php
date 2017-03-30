<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesPreviewController extends Controller
{
    public function show(Article $article)
    {
        $nextArticle = (object)['slug' => ''];
        return view('front.articles.page')->with(compact('article', 'nextArticle'));
    }
}
