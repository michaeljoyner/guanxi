@extends('admin.base')

@section('content')
    <h2>Hello, {{ Auth::user()->profile->name }}</h2>
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

@endsection