@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

@endsection

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $article->getTranslation('title', $lang) }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/content/articles/{{ $article->id }}" class="btn btn-light dd-btn">Article Overview</a>
        </div>
    </section>

    <editor post-id="{{ $article->id }}"
            post-content='{{ in_array($lang, $article->getTranslatedLocales('body')) ? $article->getTranslation('body', $lang) : "" }}'
            content-lang="{{ $lang }}"
    ></editor>
@endsection

@section('bodyscripts')

@endsection