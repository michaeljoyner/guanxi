<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleFeaturedImagesController extends Controller
{
    public function edit(Article $article)
    {
        return view('admin.articles.featuredimages.edit')->with(compact('article'));
    }
}
