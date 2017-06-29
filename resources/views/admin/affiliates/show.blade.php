@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $affiliate->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/affiliates/{{ $affiliate->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $affiliate->name,
                'deleteFormAction' => '/admin/affiliates/' . $affiliate->id
            ])
        </div>

    </section>
    <section class="profile-show-page">
        <div class="row">
            <div class="col-md-5">
                <p class="field-label">Address</p>
                <p>{{ $affiliate->getTranslation('location', 'en') }}</p>
                <p class="field-label">Chinese Address</p>
                <p>{{ $affiliate->getTranslation('location', 'zh') }}</p>
                <p class="field-label">Website</p>
                <p>{{ $affiliate->getSocialLink('website') ?? 'Not Given' }}</p>
                <p class="field-label">Phone number</p>
                <p>{{ $affiliate->phone ?? 'Not Given' }}</p>
            </div>
            <div class="col-md-7">
                <p class="lead">Should this be public?</p>
                <toggle-switch identifier="1"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $affiliate->published ? 'true' : 'false' }}"
                               toggle-url="/admin/affiliates/{{ $affiliate->id }}/publish"
                               toggle-attribute="publish"
                ></toggle-switch>
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $affiliate->imageSrc('thumb') }}"
                                   url="/admin/affiliates/{{ $affiliate->id }}/image"
                                   shape="square"
                                   size="preview"
                                   :preview-width="400"
                                   :preview-height="320"
                    ></single-upload>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p class="field-label">Writeup</p>
                <p>{!! nl2br($affiliate->getTranslation('writeup', 'en')) !!}</p>
            </div>
            <div class="col-md-6">
                <p class="field-label">Chinese Writeup</p>
                <p>{!! nl2br($affiliate->getTranslation('writeup', 'zh')) !!}</p>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection