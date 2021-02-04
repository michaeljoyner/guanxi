<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleMetaInfoForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        if(request()->user()->isSuperAdmin()) {
            $articles = Article::latest()->paginate(15);
        } else {
            $articles = request()->user()->profile->articles()->latest()->paginate(15);
        }

        return view('admin.articles.index')->with(compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show')->with(compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
        ]);
    }

    public function store(CreateArticleRequest $request)
    {
        $article = $request->user()->createArticle($request->translatedTitle(), $request->designation);

        return ['redirect' => '/admin/content/articles/' . $article->id . '/body/' . $request->lang . '/edit'];
    }

    public function update(UpdateArticleMetaInfoForm $request, Article $article)
    {
        $article->updateMeta($request->requiredAttributes());

        $this->flasher->success('Success!', 'The changes have been saved.');

        return redirect('admin/content/articles/' . $article->id);
    }

    public function delete(Article $article)
    {
        $article->delete();

        $this->flasher->success('Deleted!', 'The article has been deleted');

        return redirect('/admin/content/articles');
    }
}
