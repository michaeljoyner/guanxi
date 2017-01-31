<?php

namespace App\Http\Controllers;

use App\Content\ArticlesRepository;
use App\Media\MediaRepository;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;

class BiosController extends Controller
{
    public function index()
    {
        $bios = Profile::where('published', 1)->get();

        return view('front.bios.index')->with(compact('bios'));
    }

    public function show($slug, ArticlesRepository $articlesRepository, MediaRepository $mediaRepository)
    {
        $bio = Profile::where('slug', $slug)->firstOrFail();
        $articles = $articlesRepository->paginatedProfileArticles($bio);
        $staticMedia = $mediaRepository->paginatedProfileStaticMedia($bio, request());
        $videos = $mediaRepository->paginatedProfileVideos($bio);

        return view('front.bios.show')->with(compact('bio', 'articles', 'staticMedia', 'videos'));
    }
}
