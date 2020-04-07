@extends('admin.base')

@section('content')
    <x-page-header :title="$slideshow->title">
        <delete-modal delete-url="/admin/slideshows/{{ $slideshow->id }}"
                      item="{{ $slideshow->title }}"></delete-modal>
        <a class="dd-btn btn-light ml-4" href="/admin/content/articles/{{ $slideshow->article_id }}">Back to article</a>
    </x-page-header>

    <dropzone url="/admin/slideshows/{{ $slideshow->id }}/images">
    </dropzone>
    <gallery-show geturl="/admin/slideshows/{{ $slideshow->id }}/images"
                  delete-url="/admin/slideshow-images/"
    >
    </gallery-show>
@endsection