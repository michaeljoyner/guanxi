<?php

namespace App\Http\Controllers\Admin;

use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoGalleriesController extends Controller
{
    public function show(Photo $photo)
    {
        return view('admin.photos.gallery.show')->with(compact('photo'));
    }
}
