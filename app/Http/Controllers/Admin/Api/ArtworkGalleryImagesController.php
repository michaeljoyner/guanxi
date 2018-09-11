<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\ImageUploadRequest;
use App\Media\Artwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class ArtworkGalleryImagesController extends Controller
{
    public function index(Artwork $artwork)
    {
        return $artwork->galleryImages($withMainImage = false)->map(function($image) {
            return [
                'image_id' => $image->id,
                'src' => $image->getUrl(),
                'thumb_src' => $image->getUrl('thumb')
            ];
        });
    }

    public function store(ImageUploadRequest $request, Artwork $artwork)
    {
        $image = $artwork->addGalleryImage($request->file('file'));

        return response()->json([
            'image_id' => $image->id,
            'src' => $image->getUrl(),
            'thumb_src' => $image->getUrl('thumb')
        ]);
    }

    public function delete(Artwork $artwork, Media $media)
    {
        $media->delete();

        return response()->json('ok');
    }
}
