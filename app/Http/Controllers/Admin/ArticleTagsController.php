<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleTagsController extends Controller
{
    public function index(Article $article)
    {
        return $this->articleTagsPayload($article);
    }

    public function store(Request $request, Article $article)
    {
        $this->validate($request, ['name' => 'required|max:255']);
        $article->createAndAttachTag($request->name);

        return $this->articleTagsPayload($article);
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'tag_ids' => 'array',
            'tag_ids.*' => 'integer|exists:tags,id'
        ]);

        $article->syncTags($request->tag_ids);

        return $this->articleTagsPayload($article);
    }

    protected function articleTagsPayload($article)
    {
        return $article->tags()->get()->map(function($tag) {
            return ['id' => $tag->id, 'name' => $tag->name];
        });
    }
}
