<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesBodyController extends Controller
{
    public function edit(Article $article, $lang)
    {
        if($lang !== 'en' && $lang !== 'zh') {
            return abort(422, 'Locale code in url is not acceptable');
        }

        return view('admin.articles.body.edit')->with(compact('article', 'lang'));
    }

    public function store(Request $request, Article $article, $lang)
    {
        if($lang !== 'en' && $lang !== 'zh') {
            return abort(422, 'Locale code in url is not acceptable');
        }

        $this->validate($request, ['article_body' => 'required']);

        $content = $article->setBody($request->article_body, $lang);

        return response()->json(['body' => $content]);
    }
}
