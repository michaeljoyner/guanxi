<?php

namespace App\Http\Controllers;

use App\Media\Video;
use Illuminate\Http\Request;
use App\Media\MediaRepository;

use App\Http\Requests;

class GalleriesController extends Controller
{

    /**
     * @var MediaRepository
     */
    private $repository;

    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $videos = $this->repository->paginatedVideo();
        $galleries = $this->repository->paginatedStaticMedia($request);

        return view('front.galleries.index')->with(compact('galleries', 'videos'));
    }

    public function photos()
    {
        $photos = $this->repository->paginatedPhotos();

        return view('front.galleries.photos')->with(compact('photos'));
    }

    public function art()
    {
        $artworks = $this->repository->paginatedArtworks();

        return view('front.galleries.art')->with(compact('artworks'));
    }
}
