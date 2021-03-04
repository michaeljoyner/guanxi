@extends('front.base')

@section('title')
    {{ trans('meta.contact.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.contact.title'),
        'ogDescription' => trans('meta.contact.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center contact-banner">
        <h1 class="text-white type-h1">{{ trans('contact.page.title') }}</h1>
    </header>
    <div class="about-page-content type-b1 text-center">

        @include('front.about.contact')
        <div class="max-w-3xl mx-auto border-b border-brand-super-soft-purple"></div>
        @include('front.about.contribute')
    </div>





@endsection