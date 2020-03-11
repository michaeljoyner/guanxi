@extends('admin.base')

@section('content')
    <x-page-header :title="$category->name">
        <a href="/admin/content/categories/{{ $category->id }}/edit" class="btn dd-btn btn-light mx-4">Edit</a>
        <delete-modal delete-url="/admin/content/categories/{{ $category->id }}"
                      item="{{ $category->name }}"></delete-modal>
    </x-page-header>

    <section class="">
        <div class="flex justify-between">
            <div class="w-1/2 px-6">
                <p class="text-sm uppercase text-brand-purple">Name</p>
                <p class="text-xl mb-6">{{ $category->getTranslation('name', 'en') }}</p>
                <p class="text-sm uppercase text-brand-purple">SEO Description</p>
                <p class="lead">{{ $category->getTranslation('description', 'en') }}</p>
            </div>
            <div class="w-1/2 px-6">
                <p class="text-sm uppercase text-brand-purple">Chinese Name</p>
                <p class="text-xl mb-6">{{ $category->getTranslation('name', 'zh') }}</p>
                <p class="text-sm uppercase text-brand-purple">Chinese SEO description</p>
                <p class="lead">{{ $category->getTranslation('description', 'zh') }}</p>
            </div>
        </div>
        <div class="px-6">
            <div class="single-image-uploader-box my-16 mx-auto">
                <p class="text-brand-purple text-sm uppercase">Banner Image</p>
                <p class="mb-4">Add a banner image to be used on the category page. Use an image at least 1400px wide and the ideal ratio is 10:3</p>
                <p class="mb-8">Please bear in mind that this banner image will have the name of the category centered on the image in purple text, try to use an image that allows the text to be readable.</p>
                <single-upload default="{{ $category->imageSrc('large') }}"
                               url="/admin/content/categories/{{ $category->id }}/image"
                               shape="square"
                               size="preview"
                               :preview-width="800"
                               :preview-height="240"
                ></single-upload>
            </div>
        </div>


    </section>
@endsection

