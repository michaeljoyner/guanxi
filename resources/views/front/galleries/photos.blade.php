@extends('front.base')

@section('content')
    <header class="top-page-header gallery-banner">
        <h1 class="page-header-title heavy-heading white-text">{{ trans('galleries.photopage.title') }}</h1>
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
        ></media-list>
    </section>
@endsection