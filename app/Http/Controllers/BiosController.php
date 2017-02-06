<?php

namespace App\Http\Controllers;

use App\Content\ArticlesRepository;
use App\Media\MediaRepository;
use App\People\BiosRepository;
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

    public function show($slug, BiosRepository $repository, ArticlesRepository $articlesRepository, MediaRepository $mediaRepository)
    {
        $bio = $repository->bySlug($slug);
        $nextBio = $repository->nextInLineAfter($bio);
        $articles = $repository->paginatedArticlesFor($bio);
        $staticMedia = $repository->paginatedStaticMediaFor($bio, request());
        $videos = $repository->paginatedVideoFor($bio);

        return view('front.bios.show')->with(compact('bio', 'articles', 'staticMedia', 'videos', 'nextBio'));
    }
}
