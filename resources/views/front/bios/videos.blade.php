@if($videos->count())
    <section class="py-12 px-6">
        <p class="text-brand-purple text-center type-h3 mb-16">{{ trans('bios.contributions.videos') }}</p>
        <div class="responsive-grid grid-item-96 w-full max-w-4xl mx-auto" id="videos-grid">
            @foreach($videos as $video)
                @include('front.home.videocard')
            @endforeach
            @if($videos->count() === 1)
                <div></div>
            @endif
        </div>
        <content-loader container-id="videos-grid"
                        url="{{ localUrl('/api/profiles/' . $bio->slug . '/contributions/videos') }}"
                        :has-more="{{ $videos->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.videos') }}"
        ></content-loader>
    </section>
@endif