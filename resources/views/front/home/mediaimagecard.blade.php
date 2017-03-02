<div class="media-image-card four-piece">
    <dd-lightbox :open="false"
                 title="{{ $media->title }}"
                 main-src="{{ $media->mainImageSrc('thumb') }}"
                 :gallery-images='{{
                 json_encode($media->galleryImages()->map(function($image) { return ['src' => $image->getUrl('web')]; })->toArray())
                 }}'
    ></dd-lightbox>
    <p class="media-image-card-title heavy-heading">{{ $media->getTranslation('title', Localization::getCurrentLocale()) }}</p>
    <p class="media-image-card-contributor purple-text light-heading"><a
                href="{{ localUrl("/bios/" . $media->contributor->slug) }}">{{ $media->contributor->name }}</a></p>
</div>