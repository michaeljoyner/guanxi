@extends('admin.base')

@section('content')
    <x-page-header :title="$photo->title">
        <a href="/admin/media/photos/{{ $photo->id }}" class="btn dd-btn btn-light">Back to Photo</a>
    </x-page-header>

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