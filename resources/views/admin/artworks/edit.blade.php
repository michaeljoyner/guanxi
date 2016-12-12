@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $artwork->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/artworks/{{ $artwork->id }}" class="btn dd-btn btn-light">Back to Artwork</a>
        </div>
    </section>
    <section class="edit-artwork-container">
        @include('admin.forms.artwork')
    </section>
@endsection

@section('bodyscripts')

@endsection