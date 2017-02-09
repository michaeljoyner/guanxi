<?php

namespace App\Http\Controllers;

use App\Content\ArticlesRepository;
use App\Content\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagArticlesController extends Controller
{
    public function index($slug, ArticlesRepository $repository)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $articles = $repository->withTag($tag);

        return view('front.articles.tag')->with(compact('tag', 'articles'));

    }
}
