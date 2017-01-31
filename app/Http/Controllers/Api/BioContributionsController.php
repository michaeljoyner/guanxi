<?php

namespace App\Http\Controllers\Api;

use App\Content\ArticlesRepository;
use App\Media\MediaRepository;
use App\Media\TransformsMedia;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BioContributionsController extends Controller
{
    use TransformsMedia;

    public function articles(Request $request, $slug, ArticlesRepository $repository)
    {
        $bio = Profile::where('slug', $slug)->firstOrFail();
        $page = intval($request->page ?? 1);

        $articles = $repository->paginatedProfileArticles($bio);

        $html = View::make('front.articles.loader', ['articles' => $articles])->render();

        return response()->json([
            'page' => $page,
            'remaining' => $articles->hasMorePages(),
            'content_html' => $html
        ]);
    }

    public function media(Request $request, $slug, MediaRepository $repository)
    {
        $bio = Profile::where('slug', $slug)->firstOrFail();

        $galleries = $repository->paginatedProfileStaticMedia($bio, $request);

        return $this->mediaResponse($request, $galleries);
    }

    public function videos(Request $request, $slug, MediaRepository $repository)
    {
        $bio = Profile::where('slug', $slug)->firstOrFail();
        $videos = $repository->paginatedProfileVideos($bio);
        $page = intval($request->page ?? 1);
        $html = View::make('front.videos.loader', ['videos' => $videos])->render();

        return response()->json([
            'page' => $page,
            'remaining' => $videos->hasMorePages(),
            'content_html' => $html
        ]);
    }
}
