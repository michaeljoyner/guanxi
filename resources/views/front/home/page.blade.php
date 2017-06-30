@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.home.title'),
        'ogDescription' => trans('meta.home.description')
    ])
    @if($featured)
    <style>
        .cover-splash {
            background: url({{ $featured->titleImg('large') }});
            background-size: cover;
            background-position: center;
        }
    </style>
    @endif
@endsection

@section('content')
    <section class="cover-splash">
        @if($featured)
        {{--<img src="/images/coffee.jpg" alt="Cover image">--}}
        <h1 class="cover-headline heavy-heading white-text">{{ $featured->getTranslation('title', Localization::getCurrentLocale()) }}</h1>
        <a href="{{ localUrl('/articles/' . $featured->slug) }}" class="cover-link"><span class="white-text">{{ trans('homepage.splash.button') }}</span></a>
        @endif
    </section>
    <section class="page-section articles-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('homepage.articles.heading') }}</h1>
        <div class="articles-list card-grid">
            @foreach($articles as $article)
                @include('front.home.articlecard', ['limitAmount' => true])
            @endforeach
        </div>
        <a href="{{ localUrl('/articles') }}" class="section-cta dd-btn block">{{ trans('homepage.articles.button') }}</a>
    </section>
    <section class="page-section photos-and-art-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('homepage.photos.heading') }}</h1>
        <div class="media-image-cards card-grid">
            @foreach($medias as $media)
                @include('front.home.mediaimagecard')
            @endforeach
        </div>
        <a href="{{ localUrl('/galleries') }}" class="section-cta dd-btn block">{{ trans('homepage.photos.button') }}</a>
    </section>
    <section class="page-section videos-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('homepage.videos.heading') }}</h1>
        <div class="video-cards card-grid">
            @foreach($videos as $video)
                @include('front.home.videocard')
            @endforeach
        </div>
        <a href="{{ localUrl('/galleries/videos') }}" class="section-cta dd-btn block">{{ trans('homepage.videos.button') }}</a>
    </section>
    <section class="page-section bios-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('homepage.contributors.heading') }}</h1>
        <div class="bio-cards card-grid">
            @foreach($profiles as $profile)
                @include('front.home.biocard')
            @endforeach
        </div>
        <a href="{{ localUrl('/bios') }}" class="section-cta dd-btn block">{{ trans('homepage.contributors.button') }}</a>
    </section>
    <section class="page-section affiliates-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('homepage.affiliates.heading') }}</h1>
        <div class="affiliate-cards card-grid">
            @foreach($affiliates as $affiliate)
                @include('front.home.affiliatecard')
            @endforeach
        </div>
        <a href="{{ localUrl('/affiliates') }}" class="section-cta dd-btn block">{{ trans('homepage.affiliates.button') }}</a>
    </section>
@endsection