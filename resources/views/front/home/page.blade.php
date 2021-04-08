@extends('front.base')

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.home.title'),
        'ogDescription' => trans('meta.home.description')
    ])

@endsection

@section('content')
    @include('front.home.feature-banner')
    @include('front.home.articles', ['artilces' => $articles])
    @include('front.home.videos', ['videos' => $videos])
    @include('front.home.testimonials')
@endsection