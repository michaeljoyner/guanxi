@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $photo->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/photos/{{ $photo->id }}" class="btn dd-btn btn-light">Back to Photo</a>
        </div>
    </section>
    <section class="photo-show-gallery gallery-container">
        <dropzone url="/admin/api/media/photos/{{ $photo->id }}/gallery/images">
        </dropzone>
        <gallery-show gallery="{{ $photo->id }}"
                      geturl="/admin/api/media/photos/{{ $photo->id }}/gallery/images"
                      delete-url = "/admin/api/media/photos/{{ $photo->id }}/gallery/images/"
        >
        </gallery-show>
    </section>
@endsection

@section('bodyscripts')
@endsection