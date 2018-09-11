<?php

namespace App\Http\Controllers\Admin\Api;

use App\Content\Article;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;

class ArticleFeaturedImageController extends Controller
{

    public function index(Article $article)
    {
        return $article->getMedia()->map(function($image) {
            return [
                'url' => $image->getUrl(),
                'thumb' => $image->getUrl('thumb'),
                'id' => $image->id,
                'is_feature' => $image->getCustomProperty('is_feature', false)
            ];
        });
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, ['image_id' => 'required|integer|exists:media,id']);
        $image = Media::findOrFail($request->image_id);
        $article->setFeaturedImage($image);

        return response()->json([
            'url' => $image->getUrl(),
            'thumb' => $image->getUrl('thumb'),
            'id' => $image->id,
            'is_feature' => $image->getCustomProperty('is_feature', false)
        ]);
    }

    public function store(ImageUploadRequest $request, Article $article)
    {
        $image = $article->addImage($request->file('file'));

        $article->setFeaturedImage($image);

        return response()->json([
            'url' => $image->getUrl(),
            'thumb' => $image->getUrl('thumb'),
            'id' => $image->id,
            'is_feature' => true
        ]);
    }
}
