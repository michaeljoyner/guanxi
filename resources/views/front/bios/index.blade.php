@extends('front.base')

@section('title')
    {{ trans('meta.bios.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => trans('meta.bios.title'),
        'ogDescription' => trans('meta.bios.description')
    ])
@endsection

@section('content')
    <header class="h-30-vw flex justify-center items-center bios-banner">
        <h1 class="text-white type-h1">{{ trans('bios.page.title') }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="max-w-3xl mx-auto mb-20 text-center type-b4">{{ trans('bios.page.intro') }}</p>
        <div class="responsive-grid grid-item-64 max-w-5xl mx-auto">
            @foreach($bios as $profile)
                @include('front.home.biocard')
            @endforeach
        </div>
    </section>
@endsection