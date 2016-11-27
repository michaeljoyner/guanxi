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
        <div class="col-md-6">
            <p class="h6 text-uppercase">Name</p>
            <p class="lead">{{ $category->getTranslation('name', 'en') }}</p>
            <p class="h6 text-uppercase">Chinese Name</p>
            <p class="lead">{{ $category->getTranslation('name', 'zh') }}</p>
            <p class="h6 text-uppercase">SEO Description</p>
            <p class="lead">{{ $category->getTranslation('description', 'en') }}</p>
            <p class="h6 text-uppercase">Chinese SEO description</p>
            <p class="lead">{{ $category->getTranslation('description', 'zh') }}</p>
            <p class="h6 text-uppercase">Write Up</p>
            <p class="lead">{{ $category->getTranslation('writeup', 'en') }}</p>
            <p class="h6 text-uppercase">Chinese write up</p>
            <p class="lead">{{ $category->getTranslation('writeup', 'zh') }}</p>
        </div>
        <div class="col-md-6">
            <div class="single-image-uploader-box">
                <single-upload default="{{ $category->imageSrc('thumb') }}"
                               url="/admin/content/categories/{{ $category->id }}/image"
                               shape="square"
                               size="large"
                ></single-upload>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection