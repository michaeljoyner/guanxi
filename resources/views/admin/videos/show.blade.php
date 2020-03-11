@extends('admin.base')

@section('content')
    <x-page-header :title="$video->title">
        <a href="/admin/media/videos/{{ $video->id }}/edit" class="btn dd-btn btn-light mx-4">Edit</a>
        <delete-modal delete-url="/admin/media/videos/{{ $video->id }}"
                      item="{{ $video->title }}"></delete-modal>
    </x-page-header>

    <section class="">
        <div class="flex justify-between mb-20">
            <div class="w-1/2 px-6">
                <div class="flex items-center">
                    <p class="lead">Should this be public?</p>
                    <toggle-switch identifier="1"
                                   true-label="yes"
                                   false-label="no"
                                   :initial-state="{{ $video->published ? 'true' : 'false' }}"
                                   toggle-url="/admin/media/videos/{{ $video->id }}/publish"
                                   toggle-attribute="publish"
                    ></toggle-switch>
                </div>
                <div class="my-8">
                    <p class="text-sm uppercase text-brand-purple">Title</p>
                    <p>{{ $video->getTranslation('title', 'en') }}</p>
                    <p class="text-sm uppercase text-brand-purple">Chinese Title</p>
                    <p>{{ $video->getTranslation('title', 'zh') }}</p>
                </div>



            </div>
            <div class="w-1/2 px-6">
                    <img src="{{ $video->thumbnail }}" alt="" class="block mx-auto max-w-full">
            </div>
        </div>
        <hr>
        <contributor-selector initial-name="{{ $video->contributor->name }}"
                              initial-thumbnail="{{ $video->contributor->avatar('thumb') }}"
                              initial-intro="{{ $video->contributor->getTranslation('intro', 'en') }}"
                              :can-update="true"
                              article-id="{{ $video->id }}"
                              url-base="/admin/media/videos/{{ $video->id }}/contributors/"
        ></contributor-selector>
        <div class="flex my-12 justify-between">
            <div class="w-1/2 px-6">
                <p class="text-sm uppercase text-brand-purple">Description</p>
                <p>{!! nl2br($video->getTranslation('description', 'en')) !!}</p>
            </div>
            <div class="w-1/2 px-6">
                <p class="text-sm uppercase text-brand-purple">Chinese Description</p>
                <p>{!! nl2br($video->getTranslation('description', 'zh')) !!}</p>
            </div>
        </div>
        <div class="my-12 flex justify-center">
                    {!! $video->embedHtml() !!}
        </div>
    </section>
@endsection