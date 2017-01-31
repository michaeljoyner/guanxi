@extends('admin.base')


@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Select a Featured Image</h1>
        <div class="header-actions pull-right">
            <a href="/admin/content/articles/{{ $article->id }}" class="btn dd-btn btn-dark">Back to Article</a>
        </div>
    </section>
    <featured-images post-id="{{ $article->id }}"></featured-images>
@endsection