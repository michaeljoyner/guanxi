@extends('front.base')

@section('content')
    <header class="top-page-header gallery-banner">
        <h1 class="page-header-title heavy-heading white-text">{{ trans('galleries.artpage.title') }}</h1>
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
        ></media-list>
    </section>
@endsection