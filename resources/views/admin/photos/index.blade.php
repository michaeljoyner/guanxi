@extends('admin.base')

@section('content')
    <x-page-header title="Photos and Photo Galleries">
        <new-media type="photo"></new-media>
    </x-page-header>

    <section class="flex flex-wrap">
        @foreach($photos as $photo)
            <a href="/admin/media/photos/{{ $photo->id }}">
                <div class="w-64 m-6">
                    <img src="{{ $photo->mainImageSrc('thumb') }}" alt="">
                    <p>{{ $photo->title }}</p>
                </div>
            </a>
        @endforeach
    </section>
@endsection

