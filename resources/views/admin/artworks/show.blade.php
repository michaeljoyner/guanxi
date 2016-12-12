@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $artwork->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/artworks/{{ $artwork->id }}/gallery" class="btn dd-btn btn-light">Gallery</a>
            <a href="/admin/media/artworks/{{ $artwork->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $artwork->title,
                'deleteFormAction' => '/admin/media/artworks/' . $artwork->id
            ])
        </div>
    </section>
    <section class="show-photo-section">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Should this artwork be public?</p>
                <toggle-switch identifier="1"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $artwork->published ? 'true' : 'false' }}"
                               toggle-url="/admin/media/artworks/{{ $artwork->id }}/publish"
                               toggle-attribute="publish"
                ></toggle-switch>
                <p class="field-label">Title</p>
                <p>{{ $artwork->getTranslation('title', 'en') }}</p>
                <p class="field-label">Chinese Title</p>
                <p>{{ $artwork->getTranslation('title', 'zh') }}</p>
            </div>
            <div class="col-md-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $artwork->mainImageSrc('thumb') }}"
                                   url="/admin/media/artworks/{{ $artwork->id }}/mainimage"
                                   shape="square"
                                   size="large"
                    ></single-upload>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p class="field-label">Description</p>
                <p>{!! nl2br($artwork->getTranslation('description', 'en')) !!}</p>
            </div>
            <div class="col-md-6">
                <p class="field-label">Chinese Description</p>
                <p>{!! nl2br($artwork->getTranslation('description', 'zh')) !!}</p>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection