<section class="py-20 px-6">
    <p class="max-w-3xl mx-auto text-center type-b4">{{ trans('galleries.page.intro') }}</p>
    <div class="responsive-grid grid-item-48 max-w-4xl mx-auto mt-20" id="media-box">
        @foreach($galleries as $gallery)
            @include('front.home.mediaimagecard', ['media' => $gallery])
        @endforeach
    </div>
    <media-list url="/api/galleries?page="
                lang-code="{{ Localization::getCurrentLocale() }}"
                button-text="{{ trans('buttons.more.media') }}"
                :has-more="{{ $galleries->hasMorePages() ? 'true' : 'false' }}"
    ></media-list>
</section>