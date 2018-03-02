<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageUploadRequest;
use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworkImagesController extends Controller
{
    public function store(ImageUploadRequest $request, Artwork $artwork)
    {
        $artwork->setMainImage($request->file('file'));
    }
}
