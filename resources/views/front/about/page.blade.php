@extends('front.base')

@section('content')
    <section class="page-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.page.title') }}</h1>
    </section>
    <section id="marketing" class="page-section marketing-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.marketing.heading') }}</h1>
    </section>
    <section id="events" class="page-section events-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.events.heading') }}</h1>
    </section>
    <section id="story" class="page-section story-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.story.heading') }}</h1>
    </section>
    <section id="contribute" class="page-section contribute-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.contribute.heading') }}</h1>
    </section>
    <section id="contact" class="page-section contact-section">
        <h1 class="section-heading heavy-heading centered-text">{{ trans('about.contact.heading') }}</h1>
        <div class="contact-form-section">
            @include('front.about.contactform')
        </div>
    </section>
@endsection