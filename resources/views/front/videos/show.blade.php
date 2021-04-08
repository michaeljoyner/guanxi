@extends('front.base')

@section('title')
    {{ $video->title }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url('/images/facebook_image.jpg'),
        'ogTitle' => $video->title,
        'ogDescription' => $video->description
    ])
@endsection

@section('bodyclass') novue @endsection

@section('content')
    <div class="py-20 px-6">
        <h1 class="type-h1 text-center">{{ $video->title }}</h1>
        <p class="type-b3  text-center">
            {{ $video->created_at->toFormattedDateString() }} &middot; {{ $video->contributor->name }}
        </p>
        <div class="flex justify-center text-brand-dark mt-12">
            <a href="https://twitter.com/home?status={{ urlencode($video->title . ' ' . Request::url()) }}">
                @include('svgicons.social.twitter', ['classes' => 'h-8 mx-2 hover:text-text-grey'])
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                @include('svgicons.social.facebook', ['classes' => 'h-8 mx-2 hover:text-text-grey'])
            </a>
            <a href="mailto:?&subject=Read&body={{ Request::url() }}">
                @include('svgicons.social.email', ['classes' => 'h-8 mx-2 hover:text-text-grey'])
            </a>
        </div>
    </div>
    <div class="max-w-3xl mx-auto">
        <div class="w-full relative" style="padding-bottom: 52.65%">
            {!! $video->embedHtml() !!}
        </div>

    </div>
    <p class="type-b1 max-w-3xl mx-auto my-8 px-6">{!! nl2br($video->description) !!}</p>

    @include('front.partials.buy-me-coffee')

    <div class="my-12 flex justify-center">
        <a href="{{ localUrl('/galleries/videos') }}" class="btn mr-4">{{ trans('videos.show.back_button') }}</a>
        <a href="{{ localUrl('/videos/' . $nextVideo->slug) }}" class="ml-4 btn">{{ trans('videos.show.next_button') }}</a>
    </div>
    <section class="contributor-section">
        @include('front.partials.contributorcard', ['contributor' => $video->contributor])
    </section>
    <section class="py-12">
        <h3 class="type-h3 text-center text-text-grey">{{ trans('videos.show.other_videos') }}</h3>
        <div class="flex justify-between flex-row flex-wrap mt-12">
            @foreach($otherVideos as $otherVideo)
                @include('front.home.videocard', ['video' => $otherVideo])
            @endforeach
        </div>
    </section>
@endsection