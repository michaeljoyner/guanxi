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

    <section class="py-20 px-6">
        <p class="max-w-3xl mx-auto text-center type-b4">These are the articles tagged as "{{ $tag->name }}"</p>
        <div class="responsive-grid grid-item-64 max-w-4xl mx-auto mt-20" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
            @if($articles->count() === 1)
            <div></div>
            @endif
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/content/articles/tags/' . $tag->slug) }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endsection