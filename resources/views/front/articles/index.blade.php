@extends('front.base')

@section('title')
    {{ trans('meta.articles.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.articles.title'),
        'ogDescription' => trans('meta.articles.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center articles-main-bg">
        <h1 class="type-h1 text-white">{{ trans('articles.page.title') }}</h1>
    </header>
    <section class="py-20 px-4">
        <p class="type-b4 max-w-3xl mx-auto text-center mb-12">{{ trans('articles.page.intro') }}</p>
        <div class="responsive-grid grid-item-64 max-w-4xl mx-auto" id="articles">
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