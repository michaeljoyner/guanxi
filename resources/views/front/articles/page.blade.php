@extends('front.base')

@section('content')
    <article class="article-container">
        <header class="article-header">
            <p class="article-header-category heavy-heading purple-text centered-text">
                {{ $article->categories()->first()->getTranslation('name', Localization::getCurrentLocale()) }}
            </p>
            <h1 class="heavy-heading centered-text article-header-title">
                {{ $article->getTranslation('title', Localization::getCurrentLocale()) }}
            </h1>
            <p class="article-header-date-and-contributor centered-text">
                {{ $article->created_at->toFormattedDateString() }} &middot; {{ $article->author->name }}
            </p>
            <div class="social-sharing-icons">
                <a href="https://twitter.com/home?status={{ urlencode($article->title . ' ' . Request::url()) }}">
                    @include('svgicons.social.twitter')
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                    @include('svgicons.social.facebook')
                </a>
                <a href="mailto:?&subject=Read&body={{ Request::url() }}">
                    @include('svgicons.social.email')
                </a>
            </div>
        </header>
        <section class="article-body">
            {!! $article->getTranslation('body', Localization::getCurrentLocale()) !!}
        </section>
        <div class="dd-block-btn-group">
            <a href="/articles" class="dd-btn">{{ trans('article.page.backbutton') }}</a>
            <a href="/articles/{{ $nextArticle->slug }}" class="dd-btn">{{ trans('article.page.nextbutton') }}</a>
        </div>
        <section class="contributor-section">
            @include('front.partials.contributorcard', ['contributor' => $article->author])
        </section>

    </article>
@endsection