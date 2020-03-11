@extends('admin.base')

@section('content')
    <div class="flex flex-col items-center my-12">
        <img src="{{ auth()->user()->profile->avatar('thumb') }}" class="rounded-full w-32 h-32">
        <h2 class="text-4xl">Hello, {{ Auth::user()->profile->name }}</h2>
        <p class="text-gray-600">{{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    </div>


    <div class="flex justify-center">
        @foreach($weatherLocations as $location)
            <div class="flex flex-col items-center my-6 mx-12">
                <p class="location-name">{{ $location->name }}</p>
                <p class="temperature">{{ $location->temperature }}&deg;C</p>
                <div class="text-center">
                    <img src="{{ $location->weather_icons[0] }}" alt="" class="rounded-full block mx-auto my-3">
                    <span class="weather-status">{{ $location->weather_descriptions[0] }}</span>
                </div>
            </div>
        @endforeach
    </div>
    @if(Auth::user()->isSuperAdmin())
        <div class="my-12">
            <h2 class="text-center mb-8">Where would you like to go?</h2>
            <div class="flex justify-center">
                <div class="w-32 mx-4">
                    <a href="/admin/content/articles">
                        <img src="/images/icons/article@2x.png" alt="">
                        <p class="text-center">Articles</p>
                    </a>
                </div>
                <div class="w-32 mx-4">
                    <a href="/admin/media/photos">
                        <img src="/images/icons/photo@2x.png" alt="">
                        <p class="text-center">Photos</p>
                    </a>
                </div>
                <div class="w-32 mx-4">
                    <a href="/admin/media/artworks">
                        <img src="/images/icons/artwork@2x.png" alt="">
                        <p class="text-center">Artworks</p>
                    </a>
                </div>
                <div class="w-32 mx-4">
                    <a href="/admin/media/videos">
                        <img src="/images/icons/video@2x.png" alt="">
                        <p class="text-center">Videos</p>
                    </a>
                </div>
                <div class="w-32 mx-4">
                    <a href="/admin/profiles">
                        <img src="/images/icons/bios@2x.png" alt="">
                        <p class="text-center">Bios</p>
                    </a>
                </div>
            </div>
        </div>

    @endif
@endsection