<div class="article-index-card">
    <p class="article-index-card-category heavy-heading">
        @if($article->categories->count())
            <a href="{{ localUrl('/categories/' . $article->categories->first()->slug) }}">
                {{ $article->categories->first()->name }}
            </a></p>
        @endif
    <a href="{{ localUrl('/articles/' . $article->slug) }}">
        <div class="card-image-holder">
            <img src="{{ $article->titleImg('thumb') }}" width="250" height="200" alt="{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}">
            <p class="hover-action-indicator">{{ trans('homepage.articles.hover_text') }}</p>
        </div>
    </a>
    <p class="article-index-card-headline heavy-heading">{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}</p>
    <p class="article-index-card-author purple-text light-heading"><a
                href="{{ localUrl("/bios/" . $article->author->slug) }}">{{ $article->author->name }}</a></p>
    <p class="article-index-card-description">{{ trunc($article->getTranslation('description', Localization::getCurrentLocale()), 180) }}</p>
</div>