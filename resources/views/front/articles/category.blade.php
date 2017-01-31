@extends('front.base')

@section('content')
    <header class="top-page-header articles-banner">
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