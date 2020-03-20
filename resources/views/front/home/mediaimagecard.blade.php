<div class="w-48 mx-auto max-w-full">
    <dd-lightbox :open="false"
                 title="{{ $media->title }}"
                 main-src="{{ $media->mainImageSrc('thumb') }}"
                 :gallery-images='{{
                 json_encode($media->galleryImages()->map(function($image) { return ['src' => $image->getUrl('web')]; })->toArray())
                 }}'
    ></dd-lightbox>
    <p class="type-h3">{{ $media->getTranslation('title', Localization::getCurrentLocale()) }}</p>
    @if($media->contributor)
    <p class="type-b3 text-brand-purple"><a
                href="{{ localUrl("/bios/" . $media->contributor->slug) }}">{{ $media->contributor->name }}</a></p>
    @endif
</div>