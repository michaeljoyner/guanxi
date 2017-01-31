<?php

namespace App\Http\Controllers\Admin;

use App\Media\Artwork;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworkContributorsController extends Controller
{
    public function update(Artwork $artwork, Profile $profile)
    {
        return $artwork->contributedBy($profile);
    }
}
