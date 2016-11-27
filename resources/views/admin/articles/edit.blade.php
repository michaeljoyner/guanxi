@extends('admin.base')

@section('head')
@endsection

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit this Article's Info</h1>
        <div class="header-actions pull-right">
            <a href="/admin/content/articles/{{ $article->id }}" class="btn dd-btn btn-light">Back to Article</a>
        </div>
    </section>
    <section class="edit-article-form-container">
        @include('admin.forms.article')
    </section>
@endsection

@section('bodyscripts')

@endsection