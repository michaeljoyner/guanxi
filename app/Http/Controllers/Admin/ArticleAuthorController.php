<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleAuthorController extends Controller
{
    public function update(Article $article, Profile $profile)
    {
        return $article->setAuthor($profile);
    }
}
