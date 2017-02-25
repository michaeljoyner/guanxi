@extends('front.base')

@section('title')
    {{ $tag->name . ' | ' . trans('meta.articles.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => $tag->name . ' | ' . trans('meta.about.title'),
        'ogDescription' => 'Read all Guanxi Magazine articles that have been tagged as ' . $tag->name
    ])
@endsection

@section('content')
    <header class="top-page-header tag-articles-banner">
        <h1 class="page-header-title heavy-heading">#{{ $tag->name }}</h1>
    </header>
    <section class="articles-listing">
        <p class="page-intro">These are the articles tagged as "{{ $tag->name }}"</p>
        <div class="bio-cards card-grid" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/content/articles/tags/' . $tag->slug) }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endsection