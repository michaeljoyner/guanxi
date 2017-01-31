<div class="article-index-card">
    <p class="article-index-card-category heavy-heading">{{ collect(['food', 'taiwan', 'art', 'world'])->random() }}</p>
    <a href="#">
        <div class="card-image-holder">
            <img src="http://lorempixel.com/250/200/food" width="250" height="200" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.articles.hover_text') }}</p>
        </div>
    </a>
    <p class="article-index-card-headline heavy-heading">{{ collect([
        'Graffiti in Taichung', 'Countryside Living', 'How so survive a typhoon', 'Beware the bushyban'
    ])->random() }}</p>
    <p class="article-index-card-author light-heading purple-text">{{ collect([
        'Ernest Hemingway', 'Lucy Lui', 'Alan Donald', 'Sarah Jenkins'
    ])->random() }}</p>
    <p class="article-index-card-description">{{ trunc('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi cum doloribus dolorum nobis officiis placeat quod reiciendis repellat. Architecto autem cum delectus.', 180) }}</p>
</div>