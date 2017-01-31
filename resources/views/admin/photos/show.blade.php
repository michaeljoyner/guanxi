@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $photo->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/photos/{{ $photo->id }}/gallery" class="btn dd-btn btn-light">Gallery</a>
            <a href="/admin/media/photos/{{ $photo->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $photo->title,
                'deleteFormAction' => '/admin/media/photos/' . $photo->id
            ])
        </div>
    </section>
    <section class="show-photo-section">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Should this photo be public?</p>
                <toggle-switch identifier="1"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $photo->published ? 'true' : 'false' }}"
                               toggle-url="/admin/media/photos/{{ $photo->id }}/publish"
                               toggle-attribute="publish"
                ></toggle-switch>
                <p class="field-label">Title</p>
                <p>{{ $photo->getTranslation('title', 'en') }}</p>
                <p class="field-label">Chinese Title</p>
                <p>{{ $photo->getTranslation('title', 'zh') }}</p>
                <contributor-selector initial-name="{{ $photo->contributor->name }}"
                                initial-thumbnail="{{ $photo->contributor->avatar('thumb') }}"
                                initial-intro="{{ $photo->contributor->getTranslation('intro', 'en') }}"
                                :can-update="true"
                                article-id="{{ $photo->id }}"
                                url-base="/admin/media/photos/{{ $photo->id }}/contributors/"
                ></contributor-selector>
            </div>
            <div class="col-md-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $photo->mainImageSrc('thumb') }}"
                                   url="/admin/media/photos/{{ $photo->id }}/mainimage"
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
                <p>{!! nl2br($photo->getTranslation('description', 'en')) !!}</p>
            </div>
            <div class="col-md-6">
                <p class="field-label">Chinese Description</p>
                <p>{!! nl2br($photo->getTranslation('description', 'zh')) !!}</p>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection