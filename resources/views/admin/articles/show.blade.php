@extends('admin.base')

@section('head')
@endsection

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left"></h1>
        <div class="header-actions pull-right">
            <publish-button :virgin="{{ $article->hasBeenPublished() ? 'false' : 'true' }}"
                            url="/admin/api/content/articles/{{ $article->id }}/publish"
                            :published="{{ $article->published ? 'true' : 'false' }}"
            ></publish-button>
            <a href="/admin/content/articles/{{ $article->id }}/edit" class="btn btn-light dd-btn">Edit Meta Info</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $article->title,
                'deleteFormAction' => '/admin/content/articles/' . $article->id
            ])
        </div>
    </section>
    <section class="article-overview">
        <div class="article-title-card row">
            <div class="col-md-6 article-language-card">
                <p class="h6 text-uppercase">English Title</p>
                <p class="h2">{{ $article->title }}</p>
                <p class="sub-little-heading">Description</p>
                <p class="lead">{{ $article->description }}</p>
                <div class="card-actions">
                    <a href="/admin/content/articles/{{ $article->id }}/body/en/edit" class="btn dd-btn btn-dark">Edit
                        Content</a>
                </div>
            </div>
            <div class="col-md-6 article-language-card">
                <p class="h6 text-uppercase">Chinese Title</p>
                <p class="h2">{{ $article->getTranslation('title', 'zh') ? $article->getTranslation('title', 'zh') : 'Not Set' }}</p>
                <p class="sub-little-heading">Chinese Description</p>
                <p class="lead">{{ $article->getTranslation('description', 'zh') }}</p>
                <div class="card-actions">
                    <a href="/admin/content/articles/{{ $article->id }}/body/zh/edit" class="btn dd-btn btn-dark">Edit
                        Content</a>
                </div>
            </div>
        </div>
        <div class="row">
            <category-chooser current-categories="{{ json_encode($article->categories->pluck('id')->toArray()) }}"
                              article-id="{{ $article->id }}"
            ></category-chooser>
        </div>
        <div class="row">
            <tagger article-id="{{ $article->id }}"></tagger>
        </div>
        <div class="row">
            <article-author initial-name="{{ $article->author->name }}"
                            initial-thumbnail="{{ $article->author->avatar('thumb') }}"
                            initial-intro="{{ $article->author->getTranslation('intro', 'en') }}"
                            :can-update="true"
                            article-id="{{ $article->id }}"
            ></article-author>
        </div>

        <p class="sub-little-heading">Article Link</p>
        <p>{{ url($article->slug) }}</p>
        <small>The article link will become permanent once it is published</small>

    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection