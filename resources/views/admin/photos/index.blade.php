@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Photos and Photo Galleries</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-photo-modal">
                New Photo
            </button>
        </div>
    </section>
    <section class="photo-listing">
        @foreach($photos as $photo)
            <a href="/admin/media/photos/{{ $photo->id }}">
                <div class="photo-index-card">
                    <img src="{{ $photo->mainImageSrc('thumb') }}" alt="">
                    <p>{{ $photo->title }}</p>
                </div>
            </a>
        @endforeach
    </section>
    @include('admin.forms.modals.photo')
@endsection

@section('bodyscripts')

@endsection