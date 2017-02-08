@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit the {{ $section }} section</h1>
        <div class="header-actions pull-right">
            <a href="/admin/pages/about" class="btn dd-btn btn-light">Back to About</a>
        </div>
    </section>
    <section class="edit-about-form-container">
        @include('admin.forms.aboutsection', [
            'section' => $section,
            'enContent' => $content['en'] ?? '',
            'zhContent' => $content['zh'] ?? ''
        ])
    </section>
@endsection

@section('bodyscripts')
    <script>
        tinymce.init({
            selector: '#en_textarea',
            plugins: ['link', 'paste', 'fullscreen', 'table'],
            menubar: false,
            toolbar: 'undo redo | styleselect | bold italic | bullist numlist | table link | fullscreen',
            height: 400,
            content_style: "body {font-size: 16px; max-width: 800px; margin: 0 auto; padding: 15px;} * {font-size: 16px;} img {opacity: .6; max-width: 100%; height: auto;} img[data-mce-src] {opacity: 1;}",
        });

        tinymce.init({
            selector: '#zh_textarea',
            plugins: ['link', 'paste', 'fullscreen', 'table'],
            menubar: false,
            toolbar: 'undo redo | styleselect | bold italic | bullist numlist | table link | fullscreen',
            height: 400,
            content_style: "body {font-size: 16px; max-width: 800px; margin: 0 auto; padding: 15px;} * {font-size: 16px;} img {opacity: .6; max-width: 100%; height: auto;} img[data-mce-src] {opacity: 1;}",
        });
    </script>
@endsection