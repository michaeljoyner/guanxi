@extends('admin.base')

@section('content')
    <img src="{{ Auth::user()->profile->avatar('thumb') }}" alt="" width="60" height="64" class="img-circle dashboard-profile-pic">
    <h2 class="text-center">Hello, {{ Auth::user()->profile->name }}</h2>
    <p class="lead text-center">{{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    <div class="text-center">
        @foreach($weatherLocations as $location)
            <div class="weather-card">
                <p class="location-name">{{ $location->name }}</p>
                <p class="temperature">{{ $location->temp_c }}&deg;C</p>
                <div class="text-center">
                    <img src="{{ $location->condition['icon'] }}" alt="">
                    <span class="weather-status">{{ $location->condition['text'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
    <h2 class="text-center">Where would you like to go?</h2>
    <div class="dash-nav-actions">
        <div class="nav-action-box">
            <a href="/admin/content/articles">
                <img src="/images/icons/article@2x.png" alt="">
                <p>Articles</p>
            </a>
        </div>
        <div class="nav-action-box">
            <a href="/admin/media/photos">
                <img src="/images/icons/photo@2x.png" alt="">
                <p>Photos</p>
            </a>
        </div>
        <div class="nav-action-box">
            <a href="/admin/media/artworks">
                <img src="/images/icons/artwork@2x.png" alt="">
                <p>Artworks</p>
            </a>
        </div>
        <div class="nav-action-box">
            <a href="/admin/media/videos">
                <img src="/images/icons/video@2x.png" alt="">
                <p>Videos</p>
            </a>
        </div>
        <div class="nav-action-box">
            <a href="/admin/profiles">
                <img src="/images/icons/bios@2x.png" alt="">
                <p>Bios</p>
            </a>
        </div>
        <div class="nav-action-box">
            <a href="/admin/affiliates">
                <img src="/images/icons/affiliate@2x.png" alt="">
                <p>Affiliates</p>
            </a>
        </div>
    </div>

@endsection