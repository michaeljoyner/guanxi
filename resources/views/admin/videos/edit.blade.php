@extends('admin.base')

@section('content')
    <x-page-header :title="$video->title">
        <a href="/admin/media/videos/{{ $video->id }}" class="btn dd-btn btn-light">Back to Video</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.video')
    </section>
    <div class="flex justify-center my-20">
        {!! $video->embedHtml() !!}
    </div>
@endsection

@section('bodyscripts')

@endsection