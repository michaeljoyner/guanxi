@extends('front.base')

@section('title')
    {{ trans('meta.photos.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.photos.title'),
        'ogDescription' => trans('meta.photos.description')
    ])
@endsection

@section('content')
    <header class="top-page-header gallery-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('galleries.photopage.title') }}</h1>
    </header>
    <section class="gallery-main-grid">
        <p class="page-intro">{{ trans('galleries.photopage.intro') }}</p>
        <div class="galleries card-grid">
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