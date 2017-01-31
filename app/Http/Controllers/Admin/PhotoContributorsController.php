<?php

namespace App\Http\Controllers\Admin;

use App\Media\Photo;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoContributorsController extends Controller
{
    public function update(Photo $photo, Profile $profile)
    {
        return $photo->contributedBy($profile);
    }
}
