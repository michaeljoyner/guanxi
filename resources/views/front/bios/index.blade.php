@extends('front.base')

@section('content')
    <header class="top-page-header bios-banner">
        <h1 class="page-header-title heavy-heading">{{ trans('bios.page.title') }}</h1>
    </header>
    <section class="bios-listing">
        <p class="page-intro">{{ trans('bios.page.intro') }}</p>
        <div class="bio-cards card-grid">
            @foreach($bios as $profile)
                @include('front.home.biocard')
            @endforeach
        </div>
    </section>
@endsection