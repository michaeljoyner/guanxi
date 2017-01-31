<?php


namespace App\Media;


use Illuminate\Pagination\LengthAwarePaginator;

class MediaRepository
{
    public function latestArtAndPhotos($count = 12)
    {
        $photos = collect(Photo::published()->latest()->limit($count)->get());
        $artworks = collect(Artwork::published()->latest()->limit($count)->get());

        return $photos->merge($artworks)->sortByDesc('created_at')->take($count);
    }

    public function latestVideos($count = 4)
    {
        return Video::published()->latest()->limit($count)->get();
    }

    public function paginatedStaticMedia($request, $pageSize = 8)
    {
        $photos = collect(Photo::get());
        $artworks = collect(Artwork::get());

        return $this->makePaginator($request, $photos->merge($artworks)->sortByDesc('created_at'), $pageSize);
    }

    public function paginatedProfileStaticMedia($profile, $request, $pageSize = 4)
    {
        $photos = collect($profile->photos);
        $artworks = collect($profile->artworks);

        return $this->makePaginator($request, $photos->merge($artworks)->sortByDesc('created_at'), $pageSize);
    }

    public function paginatedPhotos($pageSize = 8)
    {
        return Photo::published()->latest()->paginate($pageSize);
    }

    public function paginatedArtworks($pageSize = 8)
    {
        return Artwork::published()->latest()->paginate($pageSize);
    }

    public function paginatedVideo($pageSize = 6)
    {
        return Video::published()->latest()->paginate($pageSize);
    }

    public function videoBySlug($slug)
    {
        return Video::published()->where('slug', $slug)->firstOrFail();
    }

    public function recentVideosWithout($video, $count = 2)
    {
        return Video::published()->latest()->limit($count + 1)->get()->reject(function($vid) use ($video) {
            return $vid->id === $video->id;
        })->take($count);
    }

    public function paginatedProfileVideos($profile, $pageSize = 2)
    {
        return $profile->videos()->published()->latest()->paginate($pageSize);
    }

    protected function makePaginator($request, $items, $perPage = 18)
    {
        $page = $request->get('page', 1);
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            $items->slice($offset, $perPage)->all(),
            count($items),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }
}