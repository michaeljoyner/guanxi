<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PhotoForm;
use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{

    public function index()
    {
        $photos = Photo::latest()->get();

        return view('admin.photos.index')->with(compact('photos'));
    }

    public function show(Photo $photo)
    {
        return view('admin.photos.show')->with(compact('photo'));
    }

    public function store(PhotoForm $request)
    {
        $photo = Photo::createWithTranslations($request->requiredFields(), $request->user()->profile);

        return redirect('admin/media/photos/' . $photo->id);
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit')->with(compact('photo'));
    }

    public function update(PhotoForm $request, Photo $photo)
    {
        $photo->updateWithTranslations($request->requiredFields());

        return redirect('admin/media/photos/' . $photo->id);
    }

    public function delete(Photo $photo)
    {
        $photo->delete();

        return redirect('admin/media/photos');
    }
}
