@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

@endsection

@section('content')
    <h2>Write an Article</h2>
    {{--<textarea name="post_body" id="post-body" cols="30" rows="10"></textarea>--}}
    <editor></editor>
@endsection

@section('bodyscripts')
    {{--@include('admin.partials.tinymcescript')--}}
@endsection