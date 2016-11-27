<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageUploadRequest;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileAvatarsController extends Controller
{
    public function store(ImageUploadRequest $request, Profile $profile)
    {
        $image = $profile->setAvatar($request->file('file'));

        return $image;
    }
}
