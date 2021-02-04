<?php

namespace App\Http\Controllers;

use App\Affiliates\Affiliate;
use App\Content\ArticlesRepository;
use App\Media\MediaRepository;
use App\Pages\AboutPage;
use App\People\Profile;
use App\Testimonials\Testimonial;
use Illuminate\Http\Request;

use App\Http\Requests;
 
class PagesController extends Controller

{
    public function home(ArticlesRepository $articles, MediaRepository $media)
    {
        return view('front.home.page', [
          'testimonials' =>   Testimonial::forLocale()->public()->latest()->limit(3)->get()->map->toArray(),
            'articles' => $articles->homePageArticles(),
            'videos' => $media->latestVideos(),
        ]);
    }

    public function about()
    {
        return view('front.about.page')->with(AboutPage::getContent());
    }

}
