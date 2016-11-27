<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Http\Requests\UpdateArticleMetaInfoForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Article::latest()->get();

        return view('admin.articles.index')->with(compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show')->with(compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit')->with(compact('article'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'lang' => 'required|in:en,zh'
        ]);

        $article = $request->user()->createArticle($request->title, $request->lang);

        return redirect('/admin/content/articles/' . $article->id . '/body/' . $request->lang . '/edit');
    }

    public function update(UpdateArticleMetaInfoForm $request, Article $article)
    {
        $article->updateMeta($request->requiredAttributes());

        return redirect('admin/content/articles/' . $article->id);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return redirect('/admin/content/articles');
    }
}
