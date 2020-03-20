<section class="py-20 border-b-2 border-black px-6">
    <p class="type-h1 text-center mb-20">{{ trans('homepage.articles.heading') }}</p>
    <div class="responsive-grid grid-item-64 max-w-5xl mx-auto">
        @foreach($articles as $article)
            @include('front.home.articlecard', ['limitAmount' => true])
        @endforeach
    </div>
    <div class="text-center mt-20">
        <a href="{{ localUrl('/articles') }}" class="btn">{{ trans('homepage.articles.button') }}</a>
    </div>
</section>