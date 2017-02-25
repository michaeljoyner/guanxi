@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left"></h1>
        <div class="header-actions pull-right">
            <a href="/admin/content/categories/{{ $category->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $category->name,
                'deleteFormAction' => '/admin/content/categories/' . $category->id
            ])
        </div>
    </section>
    <section class="category-show-page">
        <div class="row">
            <div class="col-md-6">
                <p class="h6 text-uppercase">Name</p>
                <p class="lead">{{ $category->getTranslation('name', 'en') }}</p>
            </div>
            <div class="col-md-6">
                <p class="h6 text-uppercase">Chinese Name</p>
                <p class="lead">{{ $category->getTranslation('name', 'zh') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="single-image-uploader-box col-md-12 spaced">
                <p class="h6 text-uppercase">Banner Image</p>
                <p>Add a banner image to be used on the category page. Use an image at least 1400px wide and the ideal ratio is 10:3</p>
                <p>Please bear in mind that this banner image will have the name of the category centered on the image in purple text, try to use an image that allows the text to be readable.</p>
                <single-upload default="{{ $category->imageSrc('large') }}"
                               url="/admin/content/categories/{{ $category->id }}/image"
                               shape="square"
                               size="preview"
                               :preview-width="800"
                               :preview-height="240"
                ></single-upload>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="h6 text-uppercase">SEO Description</p>
                <p class="lead">{{ $category->getTranslation('description', 'en') }}</p>
                <p class="h6 text-uppercase">Write Up</p>
                <p class="lead">{{ $category->getTranslation('writeup', 'en') }}</p>
            </div>
            <div class="col-md-6">
                <p class="h6 text-uppercase">Chinese SEO description</p>
                <p class="lead">{{ $category->getTranslation('description', 'zh') }}</p>
                <p class="h6 text-uppercase">Chinese write up</p>
                <p class="lead">{{ $category->getTranslation('writeup', 'zh') }}</p>
            </div>
        </div>

    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection