<section class="py-20 border-b-2 border-black px-6">
    <p class="type-h1 text-center mb-20">{{ trans('homepage.videos.heading') }}</p>
    <div class="responsive-grid grid-item-96 w-full max-w-4xl mx-auto">
        @foreach($videos as $video)
            @include('front.home.videocard')
        @endforeach
    </div>
    <div class="text-center mt-12">
        <a href="{{ localUrl('/galleries/videos') }}" class="btn">{{ trans('homepage.videos.button') }}</a>
    </div>
</section>