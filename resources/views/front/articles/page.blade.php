@extends('front.base')

@section('title')
    {{ $article->title }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url($article->titleImg()),
        'ogTitle' => $article->title,
        'ogDescription' => $article->description
    ])
@endsection

@section('content')
    <article class="article-container">
        <header class="article-header">
            @if($article->categories->count())
            <p class="article-header-category heavy-heading purple-text centered-text">
                {{ $article->categories()->first()->getTranslation('name', Localization::getCurrentLocale()) }}
            </p>
            @endif
            <h1 class="heavy-heading centered-text article-header-title">
                {{ $article->getTranslation('title', Localization::getCurrentLocale()) }}
            </h1>
            <p class="article-header-date-and-contributor centered-text">
                {{ $article->created_at->toFormattedDateString() }} &middot; {{ $article->author->name }}
            </p>
            <div class="social-sharing-icons">
                <a target="_blank" href="https://twitter.com/home?status={{ urlencode($article->title . ' ' . Request::url()) }}">
                    @include('svgicons.social.twitter')
                </a>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                    @include('svgicons.social.facebook')
                </a>
                <a target="_blank" href="mailto:?&subject=Read&body={{ Request::url() }}">
                    @include('svgicons.social.email')
                </a>
                <a target="_blank" href="http://line.me/R/msg/text/?{{ urlencode(Request::url()) }}">
                    @include('svgicons.social.line')
                </a>
            </div>
        </header>
        <section class="article-body">
            {!! $article->getTranslation('body', Localization::getCurrentLocale()) !!}
        </section>
        @if($article->tags->count())
        <section class="article-tags">
            <p class="tag-list">@include('svgicons.tags')
            @foreach($article->tags as $tag)
                <a class="tag-link" href="{{ localUrl('/articles/tags/' . $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
            </p>
        </section>
        @endif
        <div class="dd-block-btn-group">
            <a href="/articles" class="dd-btn">{{ trans('article.page.backbutton') }}</a>
            <a href="/articles/{{ $nextArticle->slug }}" class="dd-btn">{{ trans('article.page.nextbutton') }}</a>
        </div>
        <section class="contributor-section">
            @include('front.partials.contributorcard', ['contributor' => $article->author])
        </section>

    </article>
@endsection