<?php


namespace App\Content;


class TagRepository
{
    public function unusedTags()
    {
        return Tag::all()->reject(function($tag) {
           return $tag->hasArticles();
        });
    }

    public function allByPopularity()
    {
        return Tag::withCount('articles')->get()->sortByDesc('articles_count')->values();
    }
}