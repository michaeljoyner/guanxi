@extends('admin.base')

@section('content')
    <x-page-header title="About Page Content">

    </x-page-header>

    <section class="mb-12">
        <div class="text-center">
            <h3 class="text-xl uppercase">Story</h3>
            <a href="/admin/pages/about/story/edit" class="inline-block mt-2 mb-6 text-brand-purple hover:underline">Edit</a>
        </div>

        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('story', 'en') !!}
            </div>
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('story', 'zh') !!}
            </div>
        </div>
        <div class="h-0 border-b border-brand-purple my-6 max-w-2xl mx-auto"></div>
    </section>
    <section class="about-show-story">
        <div class="text-center">
            <h3 class="text-xl uppercase">Marketing</h3>
            <a href="/admin/pages/about/marketing/edit" class="text-brand-purple mt-2 mb-6 hover:underline">Edit</a>
        </div>

        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('marketing', 'en') !!}
            </div>
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('marketing', 'zh') !!}
            </div>
        </div>
        <div class="h-0 border-b border-brand-purple my-6 max-w-2xl mx-auto"></div>
    </section>
    <section class="about-show-story">
        <div class="text-center">
            <h3 class="text-xl uppercase">Events</h3>
            <a href="/admin/pages/about/events/edit" class="text-brand-purple mt-2 mb-6 hover:underline inline-block">Edit</a>
        </div>

        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('events_text', 'en') !!}
            </div>
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('events_text', 'zh') !!}
            </div>
        </div>
        <div class="h-0 border-b border-brand-purple my-6 max-w-2xl mx-auto"></div>
    </section>
    <section class="about-show-story">
        <div class="text-center">
            <h3 class="text-xl uppercase">Contribute</h3>
            <a href="/admin/pages/about/contribute/edit" class="text-brand-purple mt-2 mb-6 hover:underline inline-block">Edit</a>
        </div>

        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('contribute', 'en') !!}
            </div>
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('contribute', 'zh') !!}
            </div>
        </div>
        <div class="h-0 border-b border-brand-purple my-6 max-w-2xl mx-auto"></div>
    </section>
    <section class="about-show-story">
        <div class="text-center">
            <h3 class="text-xl uppercase">Contact</h3>
            <a href="/admin/pages/about/contact/edit" class="text-brand-purple mt-2 mb-6 hover:underline inline-block">Edit</a>
        </div>

        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('contact', 'en') !!}
            </div>
            <div class="w-1/2 px-6">
                {!! $page->getTranslation('contact', 'zh') !!}
            </div>
        </div>
        <div class="h-0 border-b border-brand-purple my-6 max-w-2xl mx-auto"></div>
    </section>

@endsection