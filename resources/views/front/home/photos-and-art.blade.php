<section class="py-20 border-b-2 border-black px-6">
    <p class="type-h1 text-center mb-20">{{ trans('homepage.photos.heading') }}</p>
    <p class="type-b2 max-w-3xl mx-auto mb-12 text-center">{{ trans('homepage.photos.intro') }}</p>
    <img src="/images/gallery_collage.jpg" alt="collage of Guanxi media images" class="mx-auto">
    <div class="text-center mt-12">
        <a href="{{ localUrl('/galleries') }}" class="btn">{{ trans('homepage.photos.button') }}</a>
    </div>
</section>