@extends('front.base')

@section('content')
    <section class="bio-main-section">
        <div class="profile-pic-box">
            <img src="{{ $bio->avatar('web') }}" alt="{{ $bio->name }}">
        </div>
        <div class="bio-info-box">
            <h1 class="profile-name heavy-heading">{{ $bio->name }}</h1>
            <p class="profile-title purple-text light-heading">{{ $bio->getTranslation('title', Localization::getCurrentLocale()) }}</p>
            <p class="bio-full-text">{!! nl2br($bio->getTranslation('bio', Localization::getCurrentLocale())) !!}</p>
        </div>
    </section>
    <section class="bio-social-links">
        <h3 class="heavy-heading">{{ trans('bios.page.connect') . ' ' . $bio->name }}</h3>
        @foreach($bio->socialLinks as $link)
            <a href="{{ $link->link }}" class="bio-social-link">
                @include('svgicons.social.' . $link->platform)
            </a>
        @endforeach
    </section>
    <div class="dd-block-btn-group">
        <a href="{{ localUrl('/bios') }}" class="dd-btn">{{ trans('bios.page.backbutton') }}</a>
        <a href="{{ localUrl('/bios/' . $nextBio->slug) }}" class="dd-btn">{{ trans('bios.page.nextbutton') }}</a>
    </div>
    @if($articles->count())
    <hr class="page-divider">
    <section class="bio-article-listing">
        <p class="heavy-heading centered-text section-title purple-text">{{ $bio->name }}'s {{ trans('bios.contributions.title') }}</p>
        <p class="heavy-heading centered-text section-title">{{ trans('bios.contributions.articles') }}</p>
        <div class="bio-cards card-grid" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/profiles/' . $bio->slug . '/contributions/articles') }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
    @endif
    @if($staticMedia->count())
    <section class="bio-media-listing">
        <p class="heavy-heading centered-text section-title">{{ trans('bios.contributions.media') }}</p>
        <div class="galleries card-grid" id="media-box">
            @foreach($staticMedia as $gallery)
                @include('front.home.mediaimagecard', ['media' => $gallery])
            @endforeach
        </div>
        <media-list url="/api/profiles/{{ $bio->slug }}/contributions/media?page="
                    lang-code="{{ Localization::getCurrentLocale() }}"
                    button-text="{{ trans('buttons.more.media') }}"
        ></media-list>
    </section>
    @endif
    @if($videos->count())
        <section class="bio-videos-listing">
            <p class="heavy-heading centered-text section-title">{{ trans('bios.contributions.videos') }}</p>
            <div class="galleries card-grid" id="videos-grid">
                @foreach($videos as $video)
                    @include('front.home.videocard')
                @endforeach
            </div>
            <content-loader container-id="videos-grid"
                            url="{{ localUrl('/api/profiles/' . $bio->slug . '/contributions/videos') }}"
                            :has-more="{{ $videos->hasMorePages() ? 'true' : 'false' }}"
                            button-text="{{ trans('buttons.more.videos') }}"
            ></content-loader>
        </section>
    @endif

@endsection