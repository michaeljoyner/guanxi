@extends('admin.base')

@section('content')
    <x-page-header :title="'Edit Testimonial #' . $testimonial['id']">
        <a href="/admin/testimonials/{{ $testimonial['id'] }}" class="dd-btn btn-light">Back</a>
    </x-page-header>

    <div class="my-20 max-w-md mx-auto">
        <form method="POST" action="/admin/testimonials/{{ $testimonial['id'] }}" class="">
            {!! csrf_field() !!}
            <div class="">
                <div class="my-6{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="form-label" for="name">Name: </label>
                    @if($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                    <input type="text" name="name" value="{{ old('name') ?? $testimonial['name'] }}"
                           class="input-text">
                </div>
                <div class="my-6">
                    <p class="form-label">Language</p>
                    <div class="flex mt-3 pl-2">
                        <div class="mr-6">
                            <label for="english">English</label>
                            <input type="radio"
                                   id="english"
                                   name="language"
                                   value="en"
                                   @if(old('language') === 'en' || (old('language') !== 'zh' && $testimonial['language'] === 'en')) checked @endif>
                        </div>
                        <div>
                            <label for="chinese">Chinese</label>
                            <input type="radio" id="chinese" name="language" value="zh"
                                   @if(old('language') === 'zh' || (old('language') !== 'en' && $testimonial['language'] === 'zh')) checked @endif>
                        </div>
                    </div>
                </div>
                <div class="my-6{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label class="form-label" for="content">Content: </label>
                    @if($errors->has('content'))
                        <span class="error-message">{{ $errors->first('content') }}</span>
                    @endif
                    <textarea name="content" class="input-text h-40">{{ old('content') ?? $testimonial['content'] }}</textarea>
                </div>
            </div>

            <div class="my-6 flex justify-end px-6">
                <button type="submit" class="btn dd-btn">Save Changes</button>
            </div>
        </form>
    </div>
@endsection