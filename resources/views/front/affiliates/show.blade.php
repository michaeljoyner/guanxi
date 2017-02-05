@extends('front.base')

@section('content')
    <section class="affiliate-page">
        <h1 class="heavy-heading purple-text centered-text affiliate-name">{{ $affiliate->name }}</h1>
        <img src="{{ $affiliate->imageSrc('large') }}" alt="{{ $affiliate->name }}" class="affiliate-main-image">
        <p class="affiliate-address light-heading">{{ $affiliate->location }}</p>
        <div class="affiliate-writeup">
            {!! nl2br($affiliate->writeup) !!}
        </div>
        <p class="affiliate-website heavy-text"><a href="{{ $affiliate->website }}">{{ $affiliate->website }}</a></p>
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