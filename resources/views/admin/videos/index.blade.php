@extends('admin.base')

@section('content')
    <x-page-header title="Guanxi Videos">
        <new-video></new-video>
    </x-page-header>

    <section class="pb-32">
            @foreach($videos as $video)
                <div class="flex bg-gray-100 border-b border p-2">
                    <span class="flex-1"><a href="/admin/media/videos/{{ $video->id }}">{{ $video->title }}</a></span>
                    <span class="w-40 truncate">{{ $video->contributor->name ?? 'Unknown' }}</span>
                    <span class="w-40 truncate">{{ $video->published ? 'Published' : 'Unpublished' }}</span>
                </div>
            @endforeach
    </section>
@endsection