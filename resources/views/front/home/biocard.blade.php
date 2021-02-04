<div class="w-64 mx-auto">
    <a href="/bios/{{ $profile->slug }}" class="bio-image-and-link">
        <div class="group relative rounded-full overflow-hidden h-40 w-40 mx-auto">
            <img src="{{ $profile->avatar('thumb') }}" class="w-full h-full object-cover" alt="{{ $profile->name }}">
            <p class="hidden group-hover:flex justify-center items-center bg-opaque-purple text-white type-h3 absolute inset-0">{{ trans('homepage.contributors.hover_text') }}</p>
        </div>
    </a>
    <p class="text-center md:text-left type-h3 mb-1 mt-4">{{ $profile->name }}</p>
    <p class="text-center md:text-left type-b3 text-brand-purple">{{ $profile->title }}</p>
    <p class="text-center md:text-left type-b1">{{ trunc($profile->intro, 180) }}</p>

</div>