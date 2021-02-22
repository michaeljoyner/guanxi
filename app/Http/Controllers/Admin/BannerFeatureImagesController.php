<?php

namespace App\Http\Controllers\Admin;

use App\Content\BannerFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerFeatureImagesController extends Controller
{
    public function store(BannerFeature $feature)
    {
        request()->validate([
            'image' => ['required', 'image']
        ]);
        $image = $feature->setImage(request('image'));

        return ['src' => $image->getUrl('web')];
    }
}
