<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Media\UnknownPlatformException;
use App\Media\Video;
use App\Media\VideoFactory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        if(request()->user()->isSuperAdmin()) {
            $videos = Video::latest()->get();
        } else {
            $videos = Video::where('profile_id', request()->user()->profile->id)->latest()->get();
        }

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
            $this->flasher->error('Unknown Platform', 'Currently only Youtube and Vimeo are supported');
            return redirect()->back();
        } catch ( \Exception $e) {
            $this->flasher->error('Oh dear, an error', 'There was an error trying to create the video');
            return redirect()->back();
        }

        $videoModel = Video::createWithTranslations($attributes, $request->user()->profile);

        $this->flasher->success('Video Added', 'Remember to add your translations');

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

        $this->flasher->success('Success', 'Changes have been saved');

        return redirect('admin/media/videos/' . $video->id);
    }

    public function delete(Video $video)
    {
        $video->delete();

        $this->flasher->success('Video Deleted', 'The video has been removed');

        return redirect('admin/media/videos');
    }
}
