<section id="team" class="py-10 px-6">
    <h1 class="type-h1 text-center mb-20">{{ trans('about.team.heading') }}</h1>

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
        @foreach(trans('about.team.members') as $member)
        <div>
            <p class="type-h4" style="margin: .5rem;">{{ $member['name'] }}</p>
            <p class="type-b3" style="margin: .5rem;">{{ $member['title'] }}</p>
            <div class="flex justify-center">
                <a class="mr-3" href="{{ $member['facebook'] }}">@include('svgicons.social.facebook', ['classes' => 'h-6 text-brand-purple hover:text-brand-soft-purple'])</a>
                <a class="ml-3" href="mailto:{{ $member['email'] }}" target="_blank" rel="nofollow">
                    @include('svgicons.social.email', ['classes' => 'h-6 text-brand-purple hover:text-brand-soft-purple'])
                </a>
            </div>
            <p class="lg:w-80 mx-auto">{{ $member['bio'] }}</p>


        </div>
        @endforeach
    </div>
</section>