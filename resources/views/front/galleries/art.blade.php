@extends('front.base')

@section('title')
    {{ trans('meta.artworks.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.artworks.title'),
        'ogDescription' => trans('meta.artworks.description')
    ])
@endsection

@section('content')
    <header class="top-page-header artworks-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('galleries.artpage.title') }}</h1>
    </header>
    <section class="gallery-main-grid">
        <p class="page-intro">{{ trans('galleries.artpage.intro') }}</p>
        <div class="galleries card-grid">
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