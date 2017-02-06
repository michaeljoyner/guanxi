@extends('front.base')

@section('bodyclass') novue @endsection

@section('content')
    <div class="video-header article-header">
        <h1 class="heavy-heading centered-text article-header-title">{{ $video->title }}</h1>
        <p class="article-header-date-and-contributor centered-text">
            {{ $video->created_at->toFormattedDateString() }} &middot; {{ $video->contributor->name }}
        </p>
        <div class="social-sharing-icons">
            <a href="https://twitter.com/home?status={{ urlencode($video->title . ' ' . Request::url()) }}">
                @include('svgicons.social.twitter')
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                @include('svgicons.social.facebook')
            </a>
            <a href="mailto:?&subject=Read&body={{ Request::url() }}">
                @include('svgicons.social.email')
            </a>
        </div>
    </div>
    <div class="video-show-main-block">
        {!! $video->embedHtml() !!}
    </div>
    <p class="body-text constrained-text video-description">{!! nl2br($video->description) !!}</p>
    <div class="dd-block-btn-group">
        <a href="{{ localUrl('/galleries/videos') }}" class="dd-btn">{{ trans('videos.show.back_button') }}</a>
        <a href="{{ localUrl('/videos/' . $nextVideo->slug) }}" class="dd-btn">{{ trans('videos.show.next_button') }}</a>
    </div>
    <section class="contributor-section">
        @include('front.partials.contributorcard', ['contributor' => $video->contributor])
    </section>
    <section class="other-videos page-section">
        <h3 class="centered-text heavy-heading">{{ trans('videos.show.other_videos') }}</h3>
        <div class="card-grid">
            @foreach($otherVideos as $otherVideo)
                @include('front.home.videocard', ['video' => $otherVideo])
            @endforeach
        </div>
    </section>
@endsection