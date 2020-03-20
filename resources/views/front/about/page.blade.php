@extends('front.base')

@section('title')
    {{ trans('meta.about.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.about.title'),
        'ogDescription' => trans('meta.about.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center about-banner">
        <h1 class="text-white type-h1">{{ trans('about.page.title') }}</h1>
    </header>
    <div class="about-page-content type-b1 text-center">
        @include('front.about.marketing')
        <div class="max-w-3xl mx-auto border-b border-brand-super-soft-purple"></div>
        @include('front.about.events')
        <div class="max-w-3xl mx-auto border-b border-brand-super-soft-purple"></div>
        @include('front.about.story')
        <div class="max-w-3xl mx-auto border-b border-brand-super-soft-purple"></div>
        @include('front.about.contribute')
        <div class="max-w-3xl mx-auto border-b border-brand-super-soft-purple"></div>
        @include('front.about.contact')
    </div>





@endsection