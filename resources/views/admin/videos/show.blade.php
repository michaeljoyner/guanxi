@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $video->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/videos/{{ $video->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $video->title,
                'deleteFormAction' => '/admin/media/videos/' . $video->id
            ])
        </div>
    </section>
    <section class="video-show-page">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Should this be public?</p>
                <toggle-switch identifier="1"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $video->published ? 'true' : 'false' }}"
                               toggle-url="/admin/media/videos/{{ $video->id }}/publish"
                               toggle-attribute="publish"
                ></toggle-switch>
                <p class="field-label">Title</p>
                <p>{{ $video->getTranslation('title', 'en') }}</p>
                <p class="field-label">Chinese Title</p>
                <p>{{ $video->getTranslation('title', 'zh') }}</p>
                <contributor-selector initial-name="{{ $video->contributor->name }}"
                                      initial-thumbnail="{{ $video->contributor->avatar('thumb') }}"
                                      initial-intro="{{ $video->contributor->getTranslation('intro', 'en') }}"
                                      :can-update="true"
                                      article-id="{{ $video->id }}"
                                      url-base="/admin/media/videos/{{ $video->id }}/contributors/"
                ></contributor-selector>
            </div>
            <div class="col-md-6 video-embed-container">
                {!! $video->embedHtml() !!}
                <div class="video-poster">
                    <img src="{{ $video->thumbnail }}" alt="" class="video-thumbnail">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p class="field-label">Description</p>
                <p>{!! nl2br($video->getTranslation('description', 'en')) !!}</p>
            </div>
            <div class="col-md-6">
                <p class="field-label">Chinese Description</p>
                <p>{!! nl2br($video->getTranslation('description', 'zh')) !!}</p>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection