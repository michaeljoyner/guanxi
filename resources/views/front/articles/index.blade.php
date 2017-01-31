@extends('front.base')

@section('content')
    <header class="top-page-header articles-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('articles.page.title') }}</h1>
    </header>
    <section class="articles-listing">
        <p class="page-intro">{{ trans('articles.page.intro') }}</p>
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