<section class="py-20 px-6 flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 px-6">
        <div class="h-40 md:h-80 w-40 md:w-80 mx-auto max-w-full mb-6 md:mb-0">
            <img src="{{ $bio->avatar('thumb') }}" alt="{{ $bio->name }}" class="h-full w-full object-cover rounded-full">
        </div>
    </div>
    <div class="w-full md:w-1/2 px-6">
        <h1 class="type-h1">{{ $bio->name }}</h1>
        <p class="type-b3 text-brand-purple mb-6">{{ $bio->getTranslation('title', Localization::getCurrentLocale()) }}</p>
        <p class="type-b1">{!! nl2br($bio->getTranslation('bio', Localization::getCurrentLocale())) !!}</p>
    </div>
</section>
<section class="px-6">
    <h3 class="type-h3 text-center">{{ trans('bios.page.connect') . ' ' . $bio->name }}</h3>
    <div class="flex justify-center mt-6">
        @foreach($bio->socialLinks as $link)
            <a href="{{ $link->link }}" class="text-brand-purple hover:text-brand-soft-purple">
                @include('svgicons.social.' . $link->platform, ['classes' => 'h-8 mx-3'])
            </a>
        @endforeach
    </div>
    <div class="flex flex-col md:flex-row justify-center my-16 px-6 md:px-0">
        <a href="{{ localUrl('/bios') }}" class="btn md:mr-4">{{ trans('bios.page.backbutton') }}</a>
        <a href="{{ localUrl('/bios/' . $nextBio->slug) }}" class="mt-4 md:mt-0 btn md:ml-4">{{ trans('bios.page.nextbutton') }}</a>
    </div>
</section>