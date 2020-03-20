@extends('front.base')

@section('title')
    {{ trans('meta.photos.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.photos.title'),
        'ogDescription' => trans('meta.photos.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center photos-banner">
        <h1 class="type-h1 text-white">{{ trans('galleries.photopage.title') }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="type-b4 max-w-3xl mx-auto text-center mb-20">{{ trans('galleries.photopage.intro') }}</p>
        <div class="responsive-grid grid-item-48 max-w-4xl mx-auto mt-20">
            @foreach($photos as $photo)
                @include('front.home.mediaimagecard', ['media' => $photo])
            @endforeach
        </div>
        <media-list url="/api/galleries/photos?page="
                    lang-code="{{ Localization::getCurrentLocale() }}"
                    button-text="{{ trans('buttons.more.media') }}"
                    :has-more="{{ $photos->hasMorePages() ? 'true' : 'false' }}"
        ></media-list>
    </section>
@endsection