@extends('front.base')

@section('title')
    {{ $category->name . ' | ' . trans('meta.articles.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => $category->name . ' | ' . trans('meta.about.title'),
        'ogDescription' => $category->description
    ])
    <style>
        .categories-articles-banner {
            background: url({{ $category->imageSrc('large') }});
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <header class="top-page-header categories-articles-banner">
        <h1 class="page-header-title heavy-heading">{{ $category->name }}</h1>
    </header>
    <section class="articles-listing">
        <p class="page-intro">{{ $category->writeup }}</p>
        <div class="bio-cards card-grid" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/content/articles') }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endsection