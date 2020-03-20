@extends('front.base')

@section('title')
    {{ $bio->name }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => $bio->name,
        'ogDescription' => $bio->intro
    ])
@endsection

@section('content')
    @include('front.bios.profile')
    <div class="border-b max-w-3xl mx-auto"></div>
    @include('front.bios.articles', ['articles' => $articles])
    <div class="border-b max-w-3xl mx-auto"></div>
    @include('front.bios.image-media', ['staticMedia' => $staticMedia])
    <div class="border-b max-w-3xl mx-auto"></div>
    @include('front.bios.videos', ['videos' => $videos])






@endsection