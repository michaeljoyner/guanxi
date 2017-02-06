<?php


namespace App\People;


use App\Content\ArticlesRepository;
use App\Media\MediaRepository;

class BiosRepository
{

    public function bySlug($slug)
    {
        return Profile::published()->where('slug', $slug)->firstOrFail();
    }

    public function nextInLineAfter($bio)
    {
        $next = Profile::published()->where('created_at', '<', $bio->created_at)->latest()->first();

        if(! $next) {
            return Profile::published()->latest()->first();
        }

        return $next;
    }

    public function paginatedArticlesFor($bio)
    {
        return (new ArticlesRepository())->paginatedProfileArticles($bio);
    }

    public function paginatedStaticMediaFor($bio, $request)
    {
        return (new MediaRepository())->paginatedProfileStaticMedia($bio, $request);
    }

    public function paginatedVideoFor($bio)
    {
        return (new MediaRepository())->paginatedProfileVideos($bio);
    }
}