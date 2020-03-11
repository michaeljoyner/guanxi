@extends('admin.base')

@section('content')
    <x-page-header title="Art on Guanxi">
        <new-media type="artwork"></new-media>
    </x-page-header>

    <section class="flex flex-wrap">
        @foreach($artworks as $artwork)
            <a href="/admin/media/artworks/{{ $artwork->id }}">
                <div class="w-48 m-6">
                    <img src="{{ $artwork->mainImageSrc('thumb') }}" alt="">
                    <p>{{ $artwork->title }}</p>
                </div>
            </a>
        @endforeach
    </section>
@endsection