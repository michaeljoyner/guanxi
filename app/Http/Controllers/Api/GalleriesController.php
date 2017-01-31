<?php

namespace App\Http\Controllers\Api;

use App\Media\MediaRepository;
use App\Media\Photo;
use App\Media\TransformsMedia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class GalleriesController extends Controller
{
    use TransformsMedia;

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
        $galleries = $this->repository->paginatedStaticMedia($request);

        return $this->mediaResponse($request, $galleries);
    }

    public function photos(Request $request)
    {
        $galleries = $this->repository->paginatedPhotos();

        return $this->mediaResponse($request, $galleries);
    }

    public function art(Request $request)
    {
        $galleries = $this->repository->paginatedArtworks();

        return $this->mediaResponse($request, $galleries);
    }


}
