@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $video->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/media/videos/{{ $video->id }}" class="btn dd-btn btn-light">Back to Video</a>
        </div>
    </section>
    <section class="edit-video-container">
        <div class="row">
            <div class="col-md-6 video-holder">
                {!! $video->embedHtml() !!}
            </div>
            <div class="col-md-6 form-holder">
                @include('admin.forms.video')
            </div>
        </div>
    </section>
@endsection

@section('bodyscripts')

@endsection