<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\ImageUploadRequest;
use App\Media\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class PhotoGalleryImagesController extends Controller
{
    public function index(Photo $photo)
    {
        return $photo->galleryImages($withMainImage = false)->map(function($image) {
            return [
                'image_id' => $image->id,
                'src' => $image->getUrl(),
                'thumb_src' => $image->getUrl('thumb')
            ];
        });
    }

    public function store(ImageUploadRequest $request, Photo $photo)
    {
        $image = $photo->addGalleryImage($request->file('file'));

        return response()->json([
            'image_id' => $image->id,
            'src' => $image->getUrl(),
            'thumb_src' => $image->getUrl('thumb')
        ]);
    }

    public function delete(Photo $photo, Media $media)
    {
        $media->delete();

        return response()->json('ok');
    }
}
