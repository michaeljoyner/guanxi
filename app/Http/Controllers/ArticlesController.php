<?php

namespace App\Http\Controllers;

use App\Content\Article;
use App\Content\ArticlesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticlesController extends Controller
{

    public function index(ArticlesRepository $repository)
    {
        $designation = request('designation', '');
        $articles = $repository->withDesignation($designation)->paginatedArticles();
        $bannerImage = Article::bannerFor($designation);

        return view('front.articles.index', [
            'articles' => $articles,
            'designation' => $designation,
            'intro' => $this->getDesignationIntro($designation),
            'title' => $this->getDesignationTitle($designation),
            'banner' => $bannerImage,
        ]);
    }

    public function show($slug, ArticlesRepository $repository)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        if(!$article->published) {
            return abort(404);
        }

        $nextArticle = $repository->nextInLineAfter($article);

        return view('front.articles.page')->with(compact('article', 'nextArticle'));
    }

    private function getDesignationTitle($designation)
    {
        if($designation === Article::TAIWAN) {
            return trans('articles.page.taiwan_title');
        }

        if($designation === Article::WORLD) {
            return trans('articles.page.world_title');
        }

        return trans('articles.page.title');
    }

    private function getDesignationIntro($designation)
    {
        if($designation === Article::TAIWAN) {
            return trans('articles.page.intro_taiwan');
        }

        if($designation === Article::WORLD) {
            return trans('articles.page.intro_world');
        }

        return trans('articles.page.title');
    }
}
