<?php

namespace App\Http\Controllers\Admin;

use App\Content\BannerFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerFeaturesController extends Controller
{
    public function index()
    {
        return view('admin.banner-features.index', [
            'current' => BannerFeature::current()->presentForLang(app()->getLocale()),
            'features' => BannerFeature::latest()->skip(1)->limit(10)->get()->map->presentForLang(app()->getLocale()),
            ]);
    }

    public function show(BannerFeature $feature)
    {
        return view('admin.banner-features.show', [
            'feature' => $feature->presentForLang(app()->getLocale())
        ]);
    }
}
