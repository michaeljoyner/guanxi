<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Media\Video;
use Illuminate\Http\Request;

class VideoBannerFeatureController extends Controller
{
    public function store()
    {
        $video = Video::findOrFail(request('video_id'));

        return $video->feature();
    }
}
