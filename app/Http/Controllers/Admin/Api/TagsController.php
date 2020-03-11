<?php

namespace App\Http\Controllers\Admin\Api;

use App\Content\Tag;
use App\Content\TagRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(TagRepository $tagRepository)
    {
        return $tagRepository->allByPopularity()->map(function($tag) {
            return ['id' => $tag->id, 'name' => $tag->name, 'articles_count' => $tag->articles_count];
        });
    }

    public function delete(Request $request)
    {
        request()->validate([
            'tags' => ['required','array'],
            'tags.*' => ['integer', 'exists:tags,id']
        ]);

        Tag::deleteBatch($request->tags);

        return response()->json('ok');
    }
}
