@extends('admin.base')

@section('content')
    <x-page-header :title="$artwork->title">
        <a href="/admin/media/artworks/{{ $artwork->id }}/gallery" class="btn dd-btn btn-light">Gallery</a>
        <a href="/admin/media/artworks/{{ $artwork->id }}/edit" class="btn dd-btn btn-light mx-4">Edit</a>
        <delete-modal delete-url="/admin/media/artworks/{{ $artwork->id }}"
                      item="{{ $artwork->title }}"></delete-modal>
    </x-page-header>

    <section class="">
        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                <div class="flex items-center">
                    <p class="lead">Should this artwork be public?</p>
                    <toggle-switch identifier="1"
                                   true-label="yes"
                                   false-label="no"
                                   :initial-state="{{ $artwork->published ? 'true' : 'false' }}"
                                   toggle-url="/admin/media/artworks/{{ $artwork->id }}/publish"
                                   toggle-attribute="publish"
                    ></toggle-switch>
                </div>
                <div class="my-6">
                    <p class="text-sm uppercase text-brand-purple">Title</p>
                    <p class="mb-4">{{ $artwork->getTranslation('title', 'en') }}</p>
                    <p class="text-sm uppercase text-brand-purple">Description</p>
                    <p>{!! nl2br($artwork->getTranslation('description', 'en')) !!}</p>
                </div>
                <div>
                    <p class="text-sm uppercase text-brand-purple">Chinese Title</p>
                    <p class="mb-4">{{ $artwork->getTranslation('title', 'zh') }}</p>
                    <p class="text-sm uppercase text-brand-purple">Chinese Description</p>
                    <p>{!! nl2br($artwork->getTranslation('description', 'zh')) !!}</p>
                </div>



            </div>
            <div class="w-1/2 px-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $artwork->mainImageSrc('thumb') }}"
                                   url="/admin/media/artworks/{{ $artwork->id }}/mainimage"
                                   shape="square"
                                   size="preview"
                                   :preview-width="250"
                                   :preview-height="200"
                    ></single-upload>
                </div>
            </div>
        </div>
        <hr class="my-12">
        <div class="pb-32">
            <contributor-selector initial-name="{{ $artwork->contributor->name }}"
                                  initial-thumbnail="{{ $artwork->contributor->avatar('thumb') }}"
                                  initial-intro="{{ $artwork->contributor->getTranslation('intro', 'en') }}"
                                  :can-update="true"
                                  article-id="{{ $artwork->id }}"
                                  url-base="/admin/media/artworks/{{ $artwork->id }}/contributors/"
            ></contributor-selector>
        </div>
    </section>
@endsection