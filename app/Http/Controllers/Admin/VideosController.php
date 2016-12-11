<?php

namespace App\Http\Controllers\Admin;

use App\Media\UnknownPlatformException;
use App\Media\Video;
use App\Media\VideoFactory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index')->with(compact('videos'));
    }

    public function show(Video $video)
    {
        return view('admin.videos.show')->with(compact('video'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['video_url' => 'required']);
        $video = VideoFactory::createEmbeddedVideo($request->video_url);

        try {
            $attributes = $video->attributes();
        } catch( UnknownPlatformException $unknown) {
            dd($unknown);
            return redirect()->back();
        } catch ( \Exception $e) {
            dd($e);
            return redirect()->back();
        }

        $videoModel = Video::createWithTranslations($attributes, $request->user()->profile);

        return redirect('admin/media/videos/' . $videoModel->id . '/edit');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit')->with(compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $this->validate($request, ['title' => 'required']);

        $video->updateWithTranslations([
            'title' => $request->title,
            'zh_title' => $request->zh_title ?: '',
            'description' => $request->description ?: '',
            'zh_description' => $request->zh_description ?: ''
        ]);

        return redirect('admin/media/videos/' . $video->id);
    }

    public function delete(Video $video)
    {
        $video->delete();

        return redirect('admin/media/videos');
    }
}
