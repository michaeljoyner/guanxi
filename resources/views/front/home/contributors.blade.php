<section class="py-20 px-6">
    <p class="type-h1 mb-20 text-center">{{ trans('homepage.contributors.heading') }}</p>
    <div class="responsive-grid grid-item-64 max-w-5xl mx-auto">
        @foreach($profiles as $profile)
            @include('front.home.biocard')
        @endforeach
    </div>
    <div class="text-center mt-12">
        <a href="{{ localUrl('/bios') }}" class="btn">{{ trans('homepage.contributors.button') }}</a>
    </div>
</section>