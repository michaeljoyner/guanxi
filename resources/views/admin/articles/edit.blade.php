@extends('admin.base')

@section('head')
@endsection

@section('content')
    <x-page-header :title="$article->title">
        <a href="/admin/content/articles/{{ $article->id }}" class="btn dd-btn btn-light">Back to Article</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.article')
    </section>
@endsection

@section('bodyscripts')

@endsection