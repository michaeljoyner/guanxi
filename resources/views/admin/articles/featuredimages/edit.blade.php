@extends('admin.base')


@section('content')
    <x-page-header title="Select the title image">
        <a href="/admin/content/articles/{{ $article->id }}" class="dd-btn btn-light">Back to Article</a>
    </x-page-header>

    <featured-images article-title="{{ $article->title }}" post-id="{{ $article->id }}"></featured-images>
@endsection