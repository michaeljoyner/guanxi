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
    <header class="h-30-vw flex justify-center items-center categories-articles-banner">
        <h1 class="text-white type-h1">{{ $category->name }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="type-b4 max-w-3xl mx-auto text-center mb-20">{{ $category->writeup }}</p>
        <div class="responsive-grid grid-item-64 max-w-4xl mx-auto" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/content/categories/' . $category->slug) }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endsection