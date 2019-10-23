@foreach($articles as $article)
    @include('front.home.articlecard', ['article' => $article])
@endforeach