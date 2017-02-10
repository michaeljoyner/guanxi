@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Categories</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-category-modal">
                New Category
            </button>
        </div>
    </section>
    <section>
        @foreach($categories as $category)
            <a href="/admin/content/categories/{{ $category->id }}">
                <div class="category-index-card">
                    <img src="{{ $category->imageSrc('thumb') }}" alt="">
                    <h3 class="category-name">{{ $category->name }}</h3>
                </div>
            </a>
        @endforeach
    </section>

    @include('admin.forms.modals.category')
@endsection

@section('bodyscripts')

@endsection