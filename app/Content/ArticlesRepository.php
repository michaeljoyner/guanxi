<?php


namespace App\Content;


class ArticlesRepository
{
    public function getFeaturedArticle()
    {
        $fullyFeatured = Article::published()->where('is_featured', 1)->first();

        if($fullyFeatured) {
            return $fullyFeatured;
        }

        return Article::published()->latest('published_on')->first();
    }

    public function homePageArticles()
    {
        return Article::published()->latest()->limit(9)->get();
    }

    public function paginatedArticles($pagesize = 9)
    {
        return Article::published()->latest('published_on')->paginate($pagesize);
    }

    public function paginatedCategoryArticles($category, $pageSize = 9)
    {
        return $category->articles()->published()->latest('published_on')->paginate($pageSize);
    }

    public function paginatedProfileArticles($profile, $pageSize = 3)
    {
        return $profile->articles()->published()->latest('published_on')->paginate($pageSize);
    }

    public function nextInLineAfter($article)
    {
        $next = Article::published()->where('published_on', '<', $article->published_on)->orderBy('published_on', 'desc')->first();

        if(! $next) {
            return Article::published()->latest('published_on')->first();
        }

        return $next;
    }

    public function withTag($tag)
    {
        return $tag->articles()->paginate('18');
    }
}