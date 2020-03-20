<section class="pb-20 px-6">
    <h1 class="type-h1 text-center mb-20">{{ trans('galleries.videos.heading') }}</h1>
    <div class="responsive-grid grid-item-96 w-full max-w-4xl mx-auto" id="videos-grid">
        @foreach($videos as $video)
            @include('front.home.videocard')
        @endforeach
    </div>
    <content-loader container-id="videos-grid"
                    url="{{ localUrl('/api/galleries/videos') }}"
                    :has-more="{{ $videos->hasMorePages() ? 'true' : 'false' }}"
                    button-text="{{ trans('buttons.more.videos') }}"
    ></content-loader>
</section>