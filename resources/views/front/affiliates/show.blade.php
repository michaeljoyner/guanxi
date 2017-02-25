@extends('front.base')

@section('title')
    {{ $affiliate->name . ' | ' . trans('meta.about.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => $affiliate->name . ' | ' . trans('meta.about.title'),
        'ogDescription' => trans('meta.affiliates.description')
    ])
@endsection

@section('content')
    <section class="affiliate-page">
        <img src="{{ $affiliate->imageSrc('large') }}" alt="{{ $affiliate->name }}" class="affiliate-main-image">
        <h1 class="heavy-heading purple-text centered-text affiliate-name">{{ $affiliate->name }}</h1>
        {{--<img src="{{ $affiliate->imageSrc('large') }}" alt="{{ $affiliate->name }}" class="affiliate-main-image">--}}
        <p class="affiliate-address light-heading centered-text">{{ $affiliate->location }}</p>
        <p class="affiliate-phone light-heading centered-text">Tel: {{ $affiliate->phone }}</p>
        <p class="affiliate-website heavy-text centered-text"><a href="{{ $affiliate->website }}">{{ $affiliate->website }}</a></p>
        <div class="affiliate-writeup">
            {!! nl2br($affiliate->writeup) !!}
        </div>

        <section class="bio-social-links">
            <h3 class="heavy-heading">{{ trans('bios.page.connect') . ' ' . $affiliate->name }}</h3>
            @foreach($affiliate->socialLinks as $link)
                <a href="{{ $link->link }}" class="bio-social-link">
                    @include('svgicons.social.' . $link->platform)
                </a>
            @endforeach
        </section>
        <div class="dd-block-btn-group">
            <a href="{{ localUrl('/affiliates') }}" class="dd-btn">{{ trans('affiliates.page.backbutton') }}</a>
            <a href="{{ localUrl('/affiliates/' . $nextAffiliate->slug) }}" class="dd-btn">{{ trans('affiliates.page.nextbutton') }}</a>
        </div>
    </section>
@endsection