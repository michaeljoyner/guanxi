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
        $testimonials = Testimonial::forLocale()->public()->latest()->limit(3)->get()->map->toArray();
        $featured = $articles->getFeaturedArticle();
        $articles = $articles->homePageArticles();
        $videos = $media->latestVideos();
        $profiles = Profile::where('published', 1)->latest()->limit(6)->get();
        return view('front.home.page')->with(compact('featured', 'articles', 'videos', 'profiles', 'testimonials'));
    }

    public function about()
    {
        return view('front.about.page')->with(AboutPage::getContent());
    }

}
