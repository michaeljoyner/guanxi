@extends('admin.base')

@section('head')
{{--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}
    <script src="https://cdn.tiny.cloud/1/{{ config('tiny-mce.key') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    <x-page-header :title="$article->title">
        <a href="/admin/content/articles/{{ $article->id }}" class="btn-light dd-btn">Back to Article</a>
    </x-page-header>


    <editor post-id="{{ $article->id }}"
            post-content='{{ in_array($lang, $article->getTranslatedLocales('body')) ? $article->getTranslation('body', $lang) : "" }}'
            content-lang="{{ $lang }}"
            :slideshows='@json($slideshows)'
    ></editor>
@endsection

@section('bodyscripts')

@endsection