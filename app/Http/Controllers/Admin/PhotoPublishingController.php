<?php

namespace App\Http\Controllers\Admin;

use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoPublishingController extends Controller
{
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $photo->publish() : $photo->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
