<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleImagesController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $this->validate($request, ['file' => 'required|image']);

        $image =  $article->addImage($request->file('file'));

        return response()->json(['location' => $image->getUrl('web')]);
    }
}
