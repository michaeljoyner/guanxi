<?php

namespace App\Http\Controllers\Admin;

use App\Content\Slideshow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SlideshowImagesController extends Controller
{

    public function index(Slideshow $slideshow)
    {
        return $slideshow
            ->getMedia(Slideshow::SLIDES)
            ->map(function($image) {
                return [
                    'image_id' => $image->id,
                    'src' => $image->getUrl(),
                    'thumb_src' => $image->getUrl('web')
                ];
            });
    }

    public function store(Slideshow $slideshow)
    {
        if(!$slideshow->canBeEditedBy(request()->user())) {
            return abort(403, "Forbidden");
        }
        $image = $slideshow->addImage(request('file'));

        return [
            'image_id' => $image->id,
            'src' => $image->getUrl(),
            'thumb_src' => $image->getUrl('web')
        ];
    }

    public function destroy(Media $media)
    {
        $media->delete();
    }
}
