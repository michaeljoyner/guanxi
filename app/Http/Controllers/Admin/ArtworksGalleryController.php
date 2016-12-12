<?php

namespace App\Http\Controllers\Admin;

use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworksGalleryController extends Controller
{
    public function show(Artwork $artwork)
    {
        return view('admin.artworks.gallery.show')->with(compact('artwork'));
    }
}
