<section class="home-testimonials border-b-2 border-black">
    <p class="type-h1 text-center mt-20 mb-8 px-6">{{ trans('homepage.testimonials.title') }}</p>
    <div class="w-full  py-12 px-6">
        <div class="my-12 max-w-2xl mx-auto">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" :is-left="$loop->odd"></x-testimonial-card>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ localUrl("/testimonials") }}" class="btn-purple">More testimonials</a>
        </div>
    </div>
</section>
