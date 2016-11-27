<?php

namespace App\Http\Controllers\Admin\Api;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlePublishController extends Controller
{
    public function update(Request $request, Article $article)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $article->publish() : $article->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
