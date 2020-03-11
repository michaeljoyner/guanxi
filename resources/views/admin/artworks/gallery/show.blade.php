@extends('admin.base')

@section('content')
    <x-page-header :title="$artwork->title">
        <a href="/admin/media/artworks/{{ $artwork->id }}" class="btn dd-btn btn-light">Back to Artwork</a>
    </x-page-header>

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