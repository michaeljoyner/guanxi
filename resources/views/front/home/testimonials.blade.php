<section class="flex justify-between home-testimonials border-b-2 border-black">
    <div class="w-2/5 bg-black flex justify-center items-center py-32">
        @include('svg.logo_purple', ['classes' => 'h-40 banner-logo'])
    </div>
    <div class="w-3/5 py-12 px-6">
        <span class="type-h5 border-b-2 border-brand-purple text-brand-purple">What people are saying</span>
        <div class="my-12">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" :is-left="$loop->odd"></x-testimonial-card>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ localUrl("/testimonials") }}" class="btn-purple">More testimonials</a>
        </div>
    </div>
</section>
