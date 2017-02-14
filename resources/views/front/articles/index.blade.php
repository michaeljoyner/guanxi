@extends('front.base')

@section('title')
    {{ trans('meta.articles.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.articles.title'),
        'ogDescription' => trans('meta.articles.description')
    ])
@endsection

@section('content')
    <header class="top-page-header articles-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('articles.page.title') }}</h1>
    </header>
    <section class="articles-listing">
        <p class="page-intro">{{ trans('articles.page.intro') }}</p>
        <div class="bio-cards card-grid" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard', ['withPics' => true])
            @endforeach
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/content/articles') }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endsection