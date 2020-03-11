@extends('admin.base')

@section('content')
    <x-page-header :title="$profile->name">
        @if(! $profile->hasUser())
            <new-user :roles='@json($roles)'
                      profile-id="{{ $profile->id }}"
                      profile-name="{{ $profile->name }}"></new-user>

            <delete-modal delete-url="/admin/profiles/{{ $profile->id }}" class="mx-4"
                          item="{{ $profile->name }}"></delete-modal>

        @else
            <a href="/admin/users/{{ $profile->user_id }}" class="btn dd-btn btn-dark mx-4">User Page</a>
        @endif
        <a href="/admin/profiles/{{ $profile->id }}/edit" class="btn dd-btn btn-light">Edit</a>
    </x-page-header>

    <section class="flex justify-between">
            <div class="w-1/2 px-6">
                <p class="text-xl mb-6 text-uppercase">
                    {{ $profile->getTranslation('title', 'en') }} {{ $profile->getTranslation('title', 'zh') }}
                </p>
                <p class="text-sm uppercase">Intro</p>
                <p class="mb-6">{{ $profile->getTranslation('intro', 'en') }}</p>
                <p class="text-sm uppercase">Chinese Intro</p>
                <p>{{ $profile->getTranslation('intro', 'zh') }}</p>
            </div>
            <div class="w-1/2 px-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $profile->avatar('thumb') }}"
                                   url="/admin/profiles/{{ $profile->id }}/avatar"
                                   shape="round"
                                   size="large"
                    ></single-upload>
                </div>
        </div>

    </section>
    <div class="flex justify-between my-12">
        <div class="w-1/2 px-6">
            <p class="text-sm uppercase">Bio</p>
            <p class="font-serif">{{ $profile->getTranslation('bio', 'en') }}</p>
        </div>
      <div class="w-1/2 px-6">
            <p class="text-sm uppercase">Bio</p>
            <p class="font-serif">{{ $profile->getTranslation('bio', 'zh') }}</p>
        </div>
    </div>

@endsection