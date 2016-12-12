<?php

namespace App\Http\Controllers\Admin;

use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworkPublishingController extends Controller
{
    public function update(Request $request, Artwork $artwork)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $artwork->publish() : $artwork->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
