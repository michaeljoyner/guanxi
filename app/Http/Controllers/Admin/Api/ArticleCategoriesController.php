<?php

namespace App\Http\Controllers\Admin\Api;

use App\Content\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleCategoriesController extends Controller
{
    public function update(Request $request, Article $article)
    {
        $this->validate($request, ['categories' => 'array', 'categories.*' => 'integer|exists:categories,id']);

        $article->setCategories($request->categories);

        return response()->json(['article_categories' => $article->categories->pluck('id')->toArray()]);
    }
}
