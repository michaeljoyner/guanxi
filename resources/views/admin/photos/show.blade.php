@extends('admin.base')

@section('content')
    <x-page-header :title="$photo->title">
        <a href="/admin/media/photos/{{ $photo->id }}/gallery" class="btn dd-btn btn-light">Gallery</a>
        <a href="/admin/media/photos/{{ $photo->id }}/edit" class="btn dd-btn btn-light mx-4">Edit</a>
        <delete-modal delete-url="/admin/media/photos/{{ $photo->id }}"
                      item="{{ $photo->title }}"></delete-modal>

    </x-page-header>

    <section class="">
        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                <div class="flex items-center mb-8">
                    <p class="">Should this photo be public?</p>
                    <toggle-switch identifier="1"
                                   true-label="yes"
                                   false-label="no"
                                   :initial-state="{{ $photo->published ? 'true' : 'false' }}"
                                   toggle-url="/admin/media/photos/{{ $photo->id }}/publish"
                                   toggle-attribute="publish"
                    ></toggle-switch>
                </div>

                <p class="text-sm uppercase text-brand-purple">Title</p>
                <p class="mb-2">{{ $photo->getTranslation('title', 'en') }}</p>
                <p class="text-sm uppercase text-brand-purple">Description</p>
                <p class="mb-6">{!! nl2br($photo->getTranslation('description', 'en')) !!}</p>

                <p class="text-sm uppercase text-brand-purple">Chinese Title</p>
                <p class="mb-2">{{ $photo->getTranslation('title', 'zh') }}</p>
                <p class="text-sm uppercase text-brand-purple">Chinese Description</p>
                <p>{!! nl2br($photo->getTranslation('description', 'zh')) !!}</p>


            </div>
            <div class="w-1/2 px-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $photo->mainImageSrc('thumb') }}"
                                   url="/admin/media/photos/{{ $photo->id }}/mainimage"
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
            <contributor-selector initial-name="{{ $photo->contributor->name }}"
                                  initial-thumbnail="{{ $photo->contributor->avatar('thumb') }}"
                                  initial-intro="{{ $photo->contributor->getTranslation('intro', 'en') }}"
                                  :can-update="true"
                                  article-id="{{ $photo->id }}"
                                  url-base="/admin/media/photos/{{ $photo->id }}/contributors/"
            ></contributor-selector>
        </div>


    </section>
@endsection

