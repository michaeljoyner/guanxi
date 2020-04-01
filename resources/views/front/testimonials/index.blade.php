@extends('front.base')

@section('content')
    <header class="h-30-vw flex justify-center items-center testimonials-banner">
        <h1 class="text-white type-h1">{{ trans('testimonials.intro.heading') }}</h1>
    </header>
    <section class="py-20 px-6">
        <p class="type-b4 max-w-3xl mx-auto text-center">{{ trans('testimonials.intro.text') }}</p>
        <div class="max-w-2xl mx-auto mt-20">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" :is-left="$loop->odd"></x-testimonial-card>
            @endforeach
        </div>
    </section>
@endsection