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
        return Article::published()->latest()->paginate($pagesize);
    }

    public function paginatedCategoryArticles($category, $pageSize = 9)
    {
        return $category->articles()->published()->latest()->paginate($pageSize);
    }

    public function paginatedProfileArticles($profile, $pageSize = 3)
    {
        return $profile->articles()->published()->latest()->paginate($pageSize);
    }
}