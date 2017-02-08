@extends('front.base')

@section('title')
    {{ trans('meta.affiliates.title') }}
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => url(''),
        'ogTitle' => trans('meta.affiliates.title'),
        'ogDescription' => trans('meta.affiliates.description')
    ])
@endsection

@section('content')
    <header class="top-page-header affiliates-banner">
        <h1 class="page-header-title heavy-heading white-text">{{ trans('affiliates.page.title') }}</h1>
    </header>
    <section class="affiliates-index">
        <p class="page-intro">{{ trans('affiliates.page.intro') }}</p>
        <div class="card-grid">
            @foreach($affiliates as $affiliate)
                @include('front.affiliates.large_affiliate_card')
            @endforeach
        </div>
    </section>
@endsection