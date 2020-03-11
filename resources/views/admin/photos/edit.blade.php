@extends('admin.base')

@section('content')
    <x-page-header :title="$photo->title">
        <a href="/admin/media/photos/{{ $photo->id }}" class="btn dd-btn btn-light">Back to Photo</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.photo')
    </section>
@endsection

@section('bodyscripts')

@endsection