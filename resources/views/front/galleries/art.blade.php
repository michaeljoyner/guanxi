@extends('front.base')

@section('title')
    {{ trans('meta.artworks.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.artworks.title'),
        'ogDescription' => trans('meta.artworks.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center artworks-banner">
        <h1 class="text-white type-h1">{{ trans('galleries.artpage.title') }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="max-w-3xl mx-auto text-center type-b4 mb-20">{{ trans('galleries.artpage.intro') }}</p>
        <div class="responsive-grid grid-item-48 max-w-4xl mx-auto mt-20">
            @foreach($artworks as $art)
                @include('front.home.mediaimagecard', ['media' => $art])
            @endforeach
        </div>
        <media-list url="/api/galleries/art?page="
                    lang-code="{{ Localization::getCurrentLocale() }}"
                    button-text="{{ trans('buttons.more.media') }}"
                    :has-more="{{ $artworks->hasMorePages() ? 'true' : 'false' }}"
        ></media-list>
    </section>
@endsection