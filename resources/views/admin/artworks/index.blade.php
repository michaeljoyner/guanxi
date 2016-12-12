@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Art on Guanxi</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-artwork-modal">
                New Piece
            </button>
        </div>
    </section>
    <section class="photo-listing">
        @foreach($artworks as $artwork)
            <a href="/admin/media/artworks/{{ $artwork->id }}">
                <div class="photo-index-card">
                    <img src="{{ $artwork->mainImageSrc('thumb') }}" alt="">
                </div>
            </a>
        @endforeach
    </section>
    @include('admin.forms.modals.artwork')
@endsection

@section('bodyscripts')

@endsection