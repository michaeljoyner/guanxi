<?php

namespace App\Http\Controllers\Admin;

use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilePublishingController extends Controller
{
    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $profile->publish() : $profile->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
