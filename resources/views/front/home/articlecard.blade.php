<div class="w-64 mx-auto">

    <a href="{{ localUrl('/articles/' . $article->slug) }}">
        <div class="group relative">
            <img class="w-full"
                 src="{{ $article->titleImg('thumb') }}"
                 alt="{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}">
            <p class="hidden group-hover:flex justify-center items-center text-white type-h3 font-bold absolute inset-0 bg-opaque-black">{{ trans('homepage.articles.hover_text') }}</p>
        </div>
    </a>
    <p class="font-sans text-sm text-text-grey capitalize mt-2">
        <a class="hover:text-black" href="{{ localUrl('/articles?designation=' . $article->designation) }}">
            {{ $article->designation }}
        </a>
    </p>
    <p class="type-h3 my-1">
        <a href="{{ localUrl('/articles/' . $article->slug) }}">{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}</a>
    </p>
    <p class="type-b3 text-text-grey">{{ $article->author->name }}</p>
    <p class="font-serif">{{ trunc($article->getTranslation('description', Localization::getCurrentLocale()), 180) }}</p>
</div>