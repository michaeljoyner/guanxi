<div class="article-index-card three-piece @if($loop->iteration > 6 and ($limitAmount ?? false)) far-from-top @endif">
    <p class="article-index-card-category heavy-heading">
        @if($article->categories->count())
            <a href="{{ localUrl('/categories/' . $article->categories->first()->slug) }}">
                {{ $article->categories->first()->name }}
            </a></p>
        @endif
    <a href="{{ localUrl('/articles/' . $article->slug) }}">
        <div class="card-image-holder">
            <img src="{{ $article->titleImg('thumb') }}" alt="{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}">
            <p class="hover-action-indicator">{{ trans('homepage.articles.hover_text') }}</p>
        </div>
    </a>
    <p class="article-index-card-headline heavy-heading"><a href="{{ localUrl('/articles/' . $article->slug) }}">{{ $article->getTranslation('title', Localization::getCurrentLocale()) }}</a></p>
    <p class="article-index-card-author purple-text light-heading"><a
                href="{{ localUrl("/bios/" . $article->author->slug) }}">{{ $article->author->name }}</a></p>
    <p class="article-index-card-description">{{ trunc($article->getTranslation('description', Localization::getCurrentLocale()), 180) }}</p>
</div>