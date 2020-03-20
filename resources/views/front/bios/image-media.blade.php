@if($staticMedia->count())
    <section class="py-12 px-6">
        <p class="text-brand-purple text-center type-h3 mb-16">{{ trans('bios.contributions.media') }}</p>
        <div class="responsive-grid grid-item-48 max-w-4xl mx-auto mt-20" id="media-box">
            @foreach($staticMedia as $gallery)
                @include('front.home.mediaimagecard', ['media' => $gallery])
            @endforeach
            @if($staticMedia->count() === 1)
                <div></div>
            @endif
        </div>
        <media-list url="/api/profiles/{{ $bio->slug }}/contributions/media?page="
                    lang-code="{{ Localization::getCurrentLocale() }}"
                    :has-more="{{ $staticMedia->hasMorePages() ? 'true' : 'false' }}"
                    button-text="{{ trans('buttons.more.media') }}"
        ></media-list>
    </section>
@endif