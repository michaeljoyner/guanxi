@extends('admin.base')

@section('content')
    <x-page-header :title="$artwork->title">
        <a href="/admin/media/artworks/{{ $artwork->id }}" class="btn dd-btn btn-light">Back to Artwork</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.artwork')
    </section>
@endsection