<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\PhotoForm;
use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
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
            $photos = Photo::latest()->get();
        } else {
            $photos = Photo::where('profile_id', request()->user()->profile->id)->latest()->get();
        }

        return view('admin.photos.index')->with(compact('photos'));
    }

    public function show(Photo $photo)
    {
        return view('admin.photos.show')->with(compact('photo'));
    }

    public function store(PhotoForm $request)
    {
        $photo = Photo::createWithTranslations($request->requiredFields(), $request->user()->profile);

        $this->flasher->success('Gallery Created', 'Gallery successfully added. Feel free to add more photos.');

        return ['redirect' => '/admin/media/photos/' . $photo->id];
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit')->with(compact('photo'));
    }

    public function update(PhotoForm $request, Photo $photo)
    {
        $photo->updateWithTranslations($request->requiredFields());

        $this->flasher->success('Success!', 'Gallery info updated');

        return redirect('admin/media/photos/' . $photo->id);
    }

    public function delete(Photo $photo)
    {
        $photo->delete();

        $this->flasher->success('Gallery Deleted', 'Photo gallery has been deleted');

        return redirect('admin/media/photos');
    }
}
