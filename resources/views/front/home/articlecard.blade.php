<div class="w-64 mx-auto">
        @if($article->categories->count())
        <p class="type-h3 text-brand-purple">
            <a href="{{ localUrl('/categories/' . $article->categories->first()->slug) }}">
                {{ $article->categories->first()->name }}
            </a>
        </p>
        @endif
    <a href="{{ localUrl('/articles/' . $article->slug) }}">
        <div class="group relative">
            <img class="w-full" src="{{ $article->titleImg('thumb') }}" alt="{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}">
            <p class="hidden group-hover:flex justify-center items-center text-white type-h3 font-bold absolute inset-0 bg-opaque-purple">{{ trans('homepage.articles.hover_text') }}</p>
        </div>
    </a>
    <p class="type-h3 my-1"><a href="{{ localUrl('/articles/' . $article->slug) }}">{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}</a></p>
    <p class="type-b3 text-brand-purple"><a
                href="{{ localUrl("/bios/" . $article->author->slug) }}">{{ $article->author->name }}</a></p>
    <p class="font-serif">{{ trunc($article->getTranslation('description', Localization::getCurrentLocale()), 180) }}</p>
</div>