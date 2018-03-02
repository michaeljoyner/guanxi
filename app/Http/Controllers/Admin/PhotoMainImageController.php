<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageUploadRequest;
use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoMainImageController extends Controller
{
    public function store(ImageUploadRequest $request, Photo $photo)
    {
        $photo->setMainImage($request->file('file'));
    }
}
