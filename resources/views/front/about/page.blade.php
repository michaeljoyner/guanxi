@extends('front.base')

@section('title')
    {{ trans('meta.about.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.about.title'),
        'ogDescription' => trans('meta.about.description')
    ])
@endsection

@section('content')
    <header class="top-page-header about-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('about.page.title') }}</h1>
    </header>
    <section id="marketing" class="page-section about-page-section marketing-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.marketing.heading') }}</h1>
        <div class="about-section centered-text">{!! $page->marketing !!}</div>
        <div class="section-divider"></div>
    </section>
    <section id="events" class="page-section about-page-section events-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.events.heading') }}</h1>
        <div class="about-section centered-text">{!! $page->events !!}</div>
        <div class="section-divider"></div>
    </section>
    <section id="story" class="page-section about-page-section story-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.story.heading') }}</h1>
        <div class="about-section centered-text">{!! $page->story !!}</div>
        <div class="section-divider"></div>
    </section>
    <section id="contribute" class="page-section about-page-section contribute-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.contribute.heading') }}</h1>
        <div class="about-section centered-text">{!! $page->contribute !!}</div>
        <div class="section-divider"></div>
    </section>
    <section id="contact" class="page-section about-page-section contact-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.contact.heading') }}</h1>
        <div class="about-section centered-text">{!! $page->contact !!}</div>

        <div class="contact-form-section">
            @include('front.about.contactform')
        </div>
    </section>
@endsection