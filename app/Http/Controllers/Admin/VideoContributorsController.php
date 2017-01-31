<?php

namespace App\Http\Controllers\Admin;

use App\Media\Video;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoContributorsController extends Controller
{
    public function update(Video $video, Profile $profile)
    {
        return $video->contributedBy($profile);
    }
}
