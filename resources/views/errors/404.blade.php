@extends('front.base')

@section('content')
    <div class="four-oh-four">
        <h1 class="status">{{ trans('errors.fourohfour.status') }}</h1>
        <p class="fof-subheading">{{ trans('errors.fourohfour.subheading') }}</p>
        <p class="fof-message">{{ trans('errors.fourohfour.message') }}</p>
        <img src="/images/logos/logo_purple.svg" alt="Guanxi logo">
    </div>
@endsection