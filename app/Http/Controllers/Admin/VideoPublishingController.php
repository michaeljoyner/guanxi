<?php

namespace App\Http\Controllers\Admin;

use App\Media\Video;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoPublishingController extends Controller
{
    public function update(Request $request, Video $video)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $video->publish() : $video->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
