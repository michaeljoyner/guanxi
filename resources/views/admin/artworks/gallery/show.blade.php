@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $artwork->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/artworks/{{ $artwork->id }}" class="btn dd-btn btn-light">Back to Artwork</a>
        </div>
    </section>
    <section class="photo-show-gallery gallery-container">
        <dropzone url="/admin/api/media/artworks/{{ $artwork->id }}/gallery/images">
        </dropzone>
        <gallery-show gallery="{{ $artwork->id }}"
                      geturl="/admin/api/media/artworks/{{ $artwork->id }}/gallery/images"
                      delete-url = "/admin/api/media/artworks/{{ $artwork->id }}/gallery/images/"
        >
        </gallery-show>
    </section>
@endsection

@section('bodyscripts')
@endsection