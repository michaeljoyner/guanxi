@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Articles</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-article-modal">
                New Article
            </button>
        </div>
    </section>
    <section class="article-listing">
        <table class="table">
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td><a href="/admin/content/articles/{{ $article->id }}">{{ $article->title }}</a></td>
                    <td>{{ $article->author->name }}</td>
                    <td>{{ $article->published ? 'Published' : 'Unpublished' }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.createarticlemodal')
@endsection

@section('bodyscripts')

@endsection