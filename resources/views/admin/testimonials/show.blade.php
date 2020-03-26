@extends('admin.base')

@section('content')
    <x-page-header :title="'Testimonial #' . $testimonial['id']">
        <a href="/admin/testimonials" class="dd-btn btn-light">Back</a>
        <a href="/admin/testimonials/{{ $testimonial['id'] }}/edit" class="dd-btn mx-4">Edit</a>
        <delete-modal delete-url="/admin/testimonials/{{ $testimonial['id'] }}"
                      item="{{ $testimonial['name'] }}'s testimonial"></delete-modal>
    </x-page-header>

    <div class="max-w-4xl mx-auto flex justify-between p-4 shadow">
        <strong>Publish Status:</strong>
        <testimonial-publish-switch :public="{{ $testimonial['is_published'] ? 'true' : 'false' }}" testimonial-id="{{ $testimonial['id'] }}"
        ></testimonial-publish-switch>
    </div>

    <div class="my-20 max-w-4xl mx-auto flex justify-between">
        <div class="w-1/2 px-6">
            <p class="text-xl mb-6">By: {{ $testimonial['name'] }}</p>

            <p class="text-2xl p-4 bg-gray-100 font-serif">{{ $testimonial['content'] }}</p>
        </div>
        <div class="w-1/2 px-6">
            <div class="single-image-uploader-box">
                <single-upload default="{{ $testimonial['avatar'] }}"
                               url="/admin/testimonials/{{ $testimonial['id'] }}/avatar"
                               shape="round"
                               size="large"
                ></single-upload>
            </div>
        </div>
    </div>
@endsection