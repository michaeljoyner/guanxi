@extends('admin.base')

@section('content')
    <x-page-header title="Testimonials">
        <new-testimonial></new-testimonial>
    </x-page-header>

    <div class="my-20 max-w-3xl mx-auto">
        @foreach($testimonials as $testimonial)
        <div class="flex items-center py-2 border-b bg-gray-100 px-4">

            <img src="{{ $testimonial['avatar'] }}" alt="" class="w-12 h-12 rounded-full mr-6">
            <a href="/admin/testimonials/{{ $testimonial['id'] }}" class="inline-block w-48 truncate hover:text-brand-purple">{{ $testimonial['name'] }}</a>
            <span class="w-64 truncate mr-8">{{ $testimonial['content'] }}</span>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full {{ $testimonial['is_published'] ? 'bg-brand-purple' : 'bg-gray-300' }} mr-2"></div>
                <span>{{ $testimonial['is_published'] ? 'Public' : 'Private' }}</span>
            </div>
            <span class="mx-4 uppercase font-bold">{{ $testimonial['language'] }}</span>
        </div>
        @endforeach
    </div>
@endsection