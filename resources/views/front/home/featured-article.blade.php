<section style="min-height: 40vw;" class="flex relative">
    <div class="bg-opaque-black md:bg-black w-full md:w-2/5 p-6 flex flex-col items-start relative md:static z-10 m-4 md:m-0">
        <p class="type-h5 text-brand-soft-purple border-b-4 border-brand-soft-purple pb-3">{{ trans('homepage.splash.featured_article') }}</p>
        <p class="type-h1 text-white mt-12">{{ $featured->getTranslation('title', Localization::getCurrentLocale()) }}</p>
        <a href="{{ localUrl('/articles/' . $featured->slug) }}" class="btn-purple mt-16">{{ trans('homepage.splash.button') }}</a>
    </div>
    <div class="w-full md:w-3/5 absolute md:static z-0 inset-0" style="background: url({{ $featured->titleImg('large') }}); background-size: cover; background-position: center;"></div>
</section>