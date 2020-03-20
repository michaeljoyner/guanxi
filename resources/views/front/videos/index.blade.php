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
    <header class="h-30-vw flex justify-center items-center videos-banner">
        <h1 class="text-white type-h1">{{ trans('videos.page.title') }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="max-w-3xl mx-auto text-center type-b4 mb-20">{{ trans('videos.page.intro') }}</p>
        <div class="responsive-grid grid-item-96 w-full max-w-4xl mx-auto" id="videos-grid">
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