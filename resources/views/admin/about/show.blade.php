@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Guanxi About Page Content</h1>
        <div class="header-actions pull-right">
        </div>
    </section>
    <section class="about-show-story">
        <h3 class="text-center text-uppercase">Story</h3>
        <a href="/admin/pages/about/story/edit" class="about-edit-button">Edit</a>
        <div class="row">
            <div class="col-md-6">
                {!! $page->getTranslation('story', 'en') !!}
            </div>
            <div class="col-md-6">
                {!! $page->getTranslation('story', 'zh') !!}
            </div>
        </div>
        <hr class="section-divider">
    </section>
    <section class="about-show-story">
        <h3 class="text-center text-uppercase">Marketing</h3>
        <a href="/admin/pages/about/marketing/edit" class="about-edit-button">Edit</a>
        <div class="row">
            <div class="col-md-6">
                {!! $page->getTranslation('marketing', 'en') !!}
            </div>
            <div class="col-md-6">
                {!! $page->getTranslation('marketing', 'zh') !!}
            </div>
        </div>
        <hr class="section-divider">
    </section>
    <section class="about-show-story">
        <h3 class="text-center text-uppercase">Events</h3>
        <a href="/admin/pages/about/events/edit" class="about-edit-button">Edit</a>
        <div class="row">
            <div class="col-md-6">
                {!! $page->getTranslation('events', 'en') !!}
            </div>
            <div class="col-md-6">
                {!! $page->getTranslation('events', 'zh') !!}
            </div>
        </div>
        <hr class="section-divider">
    </section>
    <section class="about-show-story">
        <h3 class="text-center text-uppercase">Contribute</h3>
        <a href="/admin/pages/about/contribute/edit" class="about-edit-button">Edit</a>
        <div class="row">
            <div class="col-md-6">
                {!! $page->getTranslation('contribute', 'en') !!}
            </div>
            <div class="col-md-6">
                {!! $page->getTranslation('contribute', 'zh') !!}
            </div>
        </div>
        <hr class="section-divider">
    </section>
    <section class="about-show-story">
        <h3 class="text-center text-uppercase">Contact</h3>
        <a href="/admin/pages/about/contact/edit" class="about-edit-button">Edit</a>
        <div class="row">
            <div class="col-md-6">
                {!! $page->getTranslation('contact', 'en') !!}
            </div>
            <div class="col-md-6">
                {!! $page->getTranslation('contact', 'zh') !!}
            </div>
        </div>
        <hr class="section-divider">
    </section>

@endsection