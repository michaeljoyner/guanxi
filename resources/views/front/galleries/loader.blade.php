@foreach($galleries as $gallery)
    @include('front.home.mediaimagecard', ['media' => $gallery])
@endforeach