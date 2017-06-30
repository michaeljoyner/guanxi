@extends('front.base')

@section('title')
    {{ trans('meta.videos.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.videos.title'),
        'ogDescription' => trans('meta.videos.description')
    ])
@endsection

@section('content')
    <header class="top-page-header videos-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('videos.page.title') }}</h1>
    </header>
    <section class="gallery-main-grid">
        <p class="page-intro">{{ trans('videos.page.intro') }}</p>
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