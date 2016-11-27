@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Categories</h1>
        <div class="header-actions pull-right">
            <a href="/admin/content/categories/{{ $category->id }}" class="btn dd-btn btn-light">Back to Category</a>
        </div>
    </section>
    <section class="category-edit-form-container">
        @include('admin.forms.category')
    </section>

@endsection

@section('bodyscripts')

@endsection