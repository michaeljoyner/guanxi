@foreach($articles as $article)
    @include('front.home.articlecard', ['withPics' => true])
@endforeach