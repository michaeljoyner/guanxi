@extends('admin.base')

@section('content')
    <x-page-header title="Banner Feature">
        <create-banner-feature></create-banner-feature>
    </x-page-header>


    <div class="my-12">
        <p class="text-xl mb-8">Current Feature</p>
        <banner-feature-preview :feature='@json($current)'></banner-feature-preview>
    </div>
    <div class="my-12">
        <p class="text-xl">Previous Features</p>

        <div class="max-w-4xl mx-auto my-12">
            @foreach($features as $feature)
                <div class="mt-2 mb-1 pb-1 border-b border-gray-300 flex items-center">
                    <p class="text-xs uppercase bg-brand-super-soft-purple border border-brand-purple rounded px-3 py-1 w-20 mr-6 text-center">{{ $feature['type'] }}</p>
                    <p>
                        {{ $feature['title'] }}
                    </p>
                </div>

            @endforeach
        </div>
    </div>
@endsection