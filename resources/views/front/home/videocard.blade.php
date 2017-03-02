<div class="video-card two-piece">
    <div class="video-aspect-container">
        <a href="{{ localUrl('/videos/' . $video->slug) }}">
            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
        </a>
    </div>
    <p class="video-card-title heavy-heading">{{ $video->title }}</p>
    <p class="video-card-contributor media-image-card-contributor purple-text light-heading">
        <a href="{{ localUrl("/bios/" . $video->contributor->slug) }}">{{ $video->contributor->name }}</a>
    </p>
</div>