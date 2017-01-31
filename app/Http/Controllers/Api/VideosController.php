<?php

namespace App\Http\Controllers\Api;

use App\Media\MediaRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class VideosController extends Controller
{

    /**
     * @var MediaRepository
     */
    private $repository;

    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function galleryVideos(Request $request)
    {
        $videos = $this->repository->paginatedVideo();

        $html = View::make('front.videos.loader', ['videos' => $videos])->render();

        return response()->json([
            'page' => $request->get('page', 1),
            'remaining' => $videos->hasMorePages(),
            'content_html' => $html
        ]);
    }
}
