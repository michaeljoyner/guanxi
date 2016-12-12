<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PhotoForm;
use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworksController extends Controller
{

    public function index()
    {
        $artworks = Artwork::latest()->get();

        return view('admin.artworks.index')->with(compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        return view('admin.artworks.show')->with(compact('artwork'));
    }

    public function store(PhotoForm $request)
    {
        $artwork = Artwork::createWithTranslations($request->requiredFields(), $request->user()->profile);

        return redirect('admin/media/artworks/' . $artwork->id);
    }

    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.edit')->with(compact('artwork'));
    }

    public function update(PhotoForm $request, Artwork $artwork)
    {
        $artwork->updateWithTranslations($request->requiredFields());

        return redirect('admin/media/artworks/' . $artwork->id);
    }

    public function delete(Artwork $artwork)
    {
        $artwork->delete();

        return redirect('admin/media/artworks');
    }
}
