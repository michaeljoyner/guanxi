<?php

namespace App\Http\Controllers\Admin\Api;

use App\Media\Video;
use App\Media\VideoFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoEmbedCodeController extends Controller
{
    public function store()
    {
        request()->validate(['url' => 'required|url']);

        $platform_video = VideoFactory::createEmbeddedVideo(request('url'));

        $video = new Video($platform_video->attributes());

        return ['embed' => $video->embedHtml()];
    }
}
