@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $photo->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/photos/{{ $photo->id }}" class="btn dd-btn btn-light">Back to Photo</a>
        </div>
    </section>
    <section class="edit-photo-container">
        @include('admin.forms.photo')
    </section>
@endsection

@section('bodyscripts')

@endsection