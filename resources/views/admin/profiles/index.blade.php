@extends('admin.base')

@section('content')
    <x-page-header title="Guanxi Contributors">
        <new-contributor></new-contributor>
    </x-page-header>

    <section class="flex flex-wrap justify-center">
    @foreach($profiles as $profile)
        <div class="w-64 mx-4 my-6 px-4 py-10 bg-eggshell relative">
            @if($profile->hasUser())
            <span class="absolute top-0 right-0 m-2 bg-brand-purple px-2 py-1 rounded text-xs text-white">User</span>
            @endif
            <a href="/admin/profiles/{{ $profile->id }}">
                <p class="text-center text-lg mb-4">{{ $profile->name }}</p>
                <img src="{{ $profile->avatar('thumb') }}" alt="" class="rounded-full w-full">
            </a>
            <p class="my-6 text-gray-600 text-center">{{ $profile->title ? $profile->title : '?' }}</p>
            <toggle-switch identifier="{{ $profile->id }}"
                           true-label="Public"
                           false-label="Private"
                           :initial-state="{{ $profile->published ? 'true' : 'false' }}"
                           toggle-url="/admin/profiles/{{ $profile->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
        </div>
    @endforeach
    </section>
@endsection

