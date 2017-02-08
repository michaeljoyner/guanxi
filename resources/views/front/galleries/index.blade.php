@extends('front.base')

@section('title')
    {{ trans('meta.gallery.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.gallery.title'),
        'ogDescription' => trans('meta.gallery.description')
    ])
@endsection

@section('content')
    <header class="top-page-header gallery-banner">
        <h1 class="page-header-title heavy-heading white-text">{{ trans('galleries.page.title') }}</h1>
    </header>
    <section class="gallery-main-grid">
        <p class="page-intro">{{ trans('galleries.page.intro') }}</p>
        <div class="galleries card-grid" id="media-box">
            @foreach($galleries as $gallery)
                @include('front.home.mediaimagecard', ['media' => $gallery])
            @endforeach
        </div>
        <media-list url="/api/galleries?page="
                    lang-code="{{ Localization::getCurrentLocale() }}"
                    button-text="{{ trans('buttons.more.media') }}"
        ></media-list>
    </section>
    <section class="gallery-video-grid page-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('galleries.videos.heading') }}</h1>
        <div class="galleries card-grid" id="videos-grid">
            @foreach($videos as $video)
                @include('front.home.videocard')
            @endforeach
        </div>
        <content-loader container-id="videos-grid"
                        url="{{ localUrl('/api/galleries/videos') }}"
                        :has-more="{{ $videos->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.videos') }}"
        ></content-loader>
    </section>
@endsection