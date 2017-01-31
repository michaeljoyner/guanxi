<?php

namespace App\Http\Controllers;

use App\Media\MediaRepository;
use App\Media\Video;
use Illuminate\Http\Request;

use App\Http\Requests;

class VideosController extends Controller
{
    public function index(MediaRepository $repository)
    {
        $videos = $repository->paginatedVideo();

        return view('front.videos.index')->with(compact('videos'));
    }

    public function show($slug, MediaRepository $repository)
    {
        $video = $repository->videoBySlug($slug);
        $otherVideos = $repository->recentVideosWithout($video);

        return view('front.videos.show')->with(compact('video', 'otherVideos'));
    }
}
