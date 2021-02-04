@extends('admin.base')

@section('head')
@endsection

@section('content')
    <x-page-header :title="$article->title">


        <a href="/admin/preview/articles/{{ $article->id }}" class="btn btn-light dd-btn mx-4"
           target="_blank">Preview</a>
        <dropdown v-cloak
                  name="Update"
                  class="dd-btn">
            <div slot="dropdown_content"
                 class="py-3 text-right">
                <a href="/admin/content/articles/{{ $article->id }}/edit"
                   class="text-brand-purple hover:underline block mb-2">Article Info</a>
                <a href="/admin/content/articles/{{ $article->id }}/body/en/edit"
                   class="text-brand-purple hover:underline block mb-2">English Content</a>
                <a href="/admin/content/articles/{{ $article->id }}/body/zh/edit"
                   class="text-brand-purple hover:underline block mb-2">Chinese Content</a>
                <a href="/admin/content/articles/{{ $article->id }}/images/featured/edit"
                   class="text-brand-purple hover:underline block mb-2">Title Image</a>
            </div>
        </dropdown>

    </x-page-header>


    <div class="flex">
        <p class="rounded border border-brand-purple bg-brand-soft-purple px-4 py-1 uppercase text-white">{{ $article->designation }}</p>
    </div>

    <div class="my-12 py-4 shadow flex justify-between">
        <div class="w-1/2 px-6 flex flex-col justify-between">
            <div>
                <p class="text-sm uppercase text-brand-purple">English Title</p>
                <p class="text-xl mb-6">{{ $article->title }}</p>
                <p class="text-sm uppercase text-brand-purple">Description</p>
                <p class="mb-6">{{ $article->description }}</p>
            </div>
        </div>
        <div class="w-1/2 px-6  flex flex-col justify-between">
            <div>
                <p class="text-sm uppercase text-brand-purple">Chinese Title</p>
                <p class="text-xl mb-6">{{ $article->getTranslation('title', 'zh') ? $article->getTranslation('title', 'zh') : 'Not Set' }}</p>
                <p class="text-sm uppercase text-brand-purple">Chinese Description</p>
                <p class="mb-6">{{ $article->getTranslation('description', 'zh') }}</p>
            </div>
        </div>
    </div>

    <publish-button :virgin="{{ $article->hasBeenPublished() ? 'false' : 'true' }}"
                    url="/admin/api/content/articles/{{ $article->id }}/publish"
                    :published="{{ $article->published ? 'true' : 'false' }}"
                    class="my-12"
    ></publish-button>

    <category-chooser current-categories="{{ json_encode($article->categories->pluck('id')->toArray()) }}"
                      article-id="{{ $article->id }}"
    ></category-chooser>

    <div class="my-12 p-4 shadow">
        <tagger article-id="{{ $article->id }}"></tagger>
    </div>

    <contributor-selector initial-name="{{ $article->author->name }}"
                          initial-thumbnail="{{ $article->author->avatar('thumb') }}"
                          initial-intro="{{ $article->author->getTranslation('intro', 'en') }}"
                          :can-update="true"
                          article-id="{{ $article->id }}"
                          url-base="/admin/content/articles/{{ $article->id }}/author/"
    ></contributor-selector>

    <div class="my-12 p-4 shadow">
        <div class="flex justify-between">
            <p class="text-sm uppercase text-brand-purple">Slideshows</p>
            <new-slideshow :article-id="{{ $article->id }}"></new-slideshow>
        </div>
        @foreach($article->slideshows as $slideshow)
        <p class="my-2">
            <a class="hover:text-brand-purple" href="/admin/slideshows/{{ $slideshow->id }}/edit">{{ $slideshow->title }}</a>
        </p>
        @endforeach

    </div>

    <div class="p-4 shadow my-12">
        <p class="text-sm uppercase text-brand-purple">Article Link</p>
        <p class="my-6">{{ url($article->slug) }}</p>
        <p class="text-gray-600">Note: The article link becomes permanent once it is published</p>
    </div>

    <div class="p-4 shadow my-12">
        <p class="text-sm uppercase text-brand-purple">Danger zone</p>
        <div class="flex justify-between mt-6">
            <p>Think carefully before you act.</p>
            <delete-modal delete-url="/admin/content/articles/{{ $article->id }}"
                          item="{{ $article->title }}"></delete-modal>
        </div>
    </div>


@endsection