<div class="flex flex-col md:flex-row justify-between py-4 border-t-2 border-b-2 border-light-grey max-w-3xl mx-auto">
    <div class="flex">
        <div class="px-4">
            <a href="{{ localUrl('/bios/' . $contributor->slug) }}">
                <img class="h-24 w-24 border border-transparent hover:border-brand-purple rounded-full" src="{{ $contributor->avatar('thumb') }}" alt="{{ $contributor->name }}">
            </a>
        </div>
        <div class="px-4">
            <p class="type-h3"><a href="{{ localUrl('/bios/' . $contributor->slug) }}">{{ $contributor->name }}</a></p>
            <p class="type-b3 text-brand-purple">{{ $contributor->getTranslation('title', Localization::getCurrentLocale()) }}</p>
        </div>
    </div>

    <div class="flex-1 type-b1 px-4 mt-6 md:mt-0">
        <p class="">{{ $contributor->getTranslation('intro', Localization::getCurrentLocale()) }}</p>
    </div>
</div>