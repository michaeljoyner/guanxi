<?php


namespace App\Content;


class ArticlesRepository
{
    protected string $designation;

    public function __construct()
    {
        $this->designation = '';
    }

    public function withDesignation($designation): self
    {
        if($designation === Article::WORLD) {
            $this->designation = Article::WORLD;
            return $this;
        }

        if($designation === Article::TAIWAN) {
            $this->designation = Article::TAIWAN;
            return $this;
        }

        return $this;
    }

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
        return $this->latestPublished(9);
    }

    public function latestPublished($count = 4)
    {
        return Article::published()->latest()->limit($count)->get();
    }

    public function paginatedArticles($pagesize = 9)
    {
        if($this->designation === Article::TAIWAN || $this->designation === Article::WORLD) {
            return Article::published()->where('designation', $this->designation)->latest('published_on')->paginate($pagesize);
        }
        return Article::published()->latest('published_on')->paginate($pagesize);
    }

    public function paginatedCategoryArticles($category, $pageSize = 9)
    {
        if($this->designation === Article::TAIWAN || $this->designation === Article::WORLD) {
            return $category->articles()->published()->where('designation', $this->designation)->latest('published_on')->paginate($pageSize);
        }

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

    public function withTag($tag, $pageSize = 9)
    {
        return $tag->articles()->paginate($pageSize);
    }
}