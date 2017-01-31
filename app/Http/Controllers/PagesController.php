<?php

namespace App\Http\Controllers;

use App\Affiliates\Affiliate;
use App\Content\ArticlesRepository;
use App\Media\MediaRepository;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home(ArticlesRepository $articles, MediaRepository $media)
    {
        $featured = $articles->getFeaturedArticle();
        $articles = $articles->homePageArticles();
        $medias = $media->latestArtAndPhotos(8);
        $videos = $media->latestVideos();
        $profiles = Profile::where('published', 1)->latest()->limit(6)->get();
        $affiliates = Affiliate::where('published', 1)->latest()->limit(8)->get();
        return view('front.home.page')->with(compact('featured', 'articles', 'medias', 'videos', 'profiles', 'affiliates'));
    }

    public function about()
    {
        return view('front.about.page');
    }

}
