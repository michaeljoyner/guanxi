@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Guanxi Videos</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-video-modal">
                New Video
            </button>
        </div>
    </section>
    <section class="video-listing">
        <table class="table">
            <tbody>
            @foreach($videos as $video)
                <tr>
                    <td><a href="/admin/media/videos/{{ $video->id }}">{{ $video->title }}</a></td>
                    <td>{{ $video->contributor->name ?? 'Unknown' }}</td>
                    <td>{{ $video->published ? 'Published' : 'Unpublished' }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.video')
@endsection

@section('bodyscripts')

@endsection