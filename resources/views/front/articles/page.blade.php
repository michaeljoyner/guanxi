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
    <article class="px-6 max-w-4xl mx-auto">
        <header class="py-20">
            @if($article->categories->count())
            <p class="type-h3 text-brand-purple text-center">
                {{ $article->categories()->first()->getTranslation('name', Localization::getCurrentLocale()) }}
            </p>
            @endif
            <h1 class="type-h1 text-center">
                {{ $article->getTranslation('title', Localization::getCurrentLocale()) }}
            </h1>
            <p class="type-b3 my-4 text-center">
                {{ $article->created_at->toFormattedDateString() }} &middot; {{ $article->author->name }}
            </p>
            <div class="flex justify-center text-brand-purple">
                <a target="_blank" href="https://twitter.com/home?status={{ urlencode($article->title . ' ' . Request::url()) }}">
                    @include('svgicons.social.twitter', ['classes' => 'h-8 mx-2 hover:text-brand-soft-purple'])
                </a>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                    @include('svgicons.social.facebook', ['classes' => 'h-8 mx-2 hover:text-brand-soft-purple'])
                </a>
                <a target="_blank" href="mailto:?&subject=Read&body={{ Request::url() }}">
                    @include('svgicons.social.email', ['classes' => 'h-8 mx-2 hover:text-brand-soft-purple'])
                </a>
                <a target="_blank" href="http://line.me/R/msg/text/?{{ urlencode(Request::url()) }}">
                    @include('svgicons.social.line', ['classes' => 'h-8 mx-2 hover:text-brand-soft-purple'])
                </a>
            </div>
        </header>

        <section class="article-content max-w-3xl mx-auto type-b1 text-base lg:text-lg leading-relaxed">
            {!! $article->parseBody(Localization::getCurrentLocale()) !!}
        </section>

        @if($article->tags->count())
        <section class="mt-20 flex flex-wrap text-brand-purple type-b1">
            @include('svgicons.tags', ['classes' => 'h-6 text-brand-purple transform -rotate-45 mr-4'])
            @foreach($article->tags as $tag)
            <a class="hover:text-brand-soft-purple mr-4 mb-4" href="{{ localUrl('/articles/tags/' . $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
        </section>
        @endif

        <div class="flex justify-center my-20">
            <a href="{{ localUrl('/articles') }}" class="btn mr-4">{{ trans('article.page.backbutton') }}</a>
            <a href="{{ localUrl('/articles/' . $nextArticle->slug) }}" class="btn ml-4">{{ trans('article.page.nextbutton') }}</a>
        </div>

        <section class="my-12">
            @if($article->author->published)
                @include('front.partials.contributorcard', ['contributor' => $article->author])
            @endif
        </section>
        <section class="article-comments">
            <div id="disqus_thread"></div>
        </section>
    </article>
@endsection

@section('bodyscripts')
    @include('front.articles.disqussnippet')
@endsection