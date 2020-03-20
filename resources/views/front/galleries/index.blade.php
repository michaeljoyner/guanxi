@extends('front.base')

@section('title')
    {{ trans('meta.gallery.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.gallery.title'),
        'ogDescription' => trans('meta.gallery.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center gallery-banner">
        <h1 class="text-white type-h1">{{ trans('galleries.page.title') }}</h1>
    </header>
    @include('front.galleries.image-galleries', ['galleries' => $galleries])
    @include('front.galleries.gallery-videos')

@endsection