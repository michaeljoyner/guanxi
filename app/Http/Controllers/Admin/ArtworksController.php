<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\PhotoForm;
use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtworksController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        if(request()->user()->isSuperAdmin()) {
            $artworks = Artwork::latest()->get();
        } else {
            $artworks = Artwork::where('profile_id', request()->user()->profile->id)->latest()->get();
        }


        return view('admin.artworks.index')->with(compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        return view('admin.artworks.show')->with(compact('artwork'));
    }

    public function store(PhotoForm $request)
    {
        $artwork = Artwork::createWithTranslations($request->requiredFields(), $request->user()->profile);

        $this->flasher->success('Album Created', 'Your art gallery has been created. Go wild.');

        return redirect('admin/media/artworks/' . $artwork->id);
    }

    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.edit')->with(compact('artwork'));
    }

    public function update(PhotoForm $request, Artwork $artwork)
    {
        $artwork->updateWithTranslations($request->requiredFields());

        $this->flasher->success('Info Updated', 'Your changes have been saved');

        return redirect('admin/media/artworks/' . $artwork->id);
    }

    public function delete(Artwork $artwork)
    {
        $artwork->delete();

        $this->flasher->success('Success', 'The album has been deleted');

        return redirect('admin/media/artworks');
    }
}
