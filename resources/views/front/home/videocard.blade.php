<div class="w-96 max-w-full mx-auto">
    <a href="{{ localUrl('/videos/' . $video->slug) }}">
        <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full">
    </a>
    <p class="type-h3 my-1">{{ $video->title }}</p>
    <p class="type-b3 text-brand-purple">
        @if($video->contributor)
        <a href="{{ localUrl("/bios/" . $video->contributor->slug) }}">{{ $video->contributor->name }}</a>
        @endif
    </p>
</div>