@extends('admin.base')

@section('content')
    <x-page-header :title="$category->name">
        <a href="/admin/content/categories/{{ $category->id }}" class="btn dd-btn btn-light">Back to Category</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.category')
    </section>

@endsection

@section('bodyscripts')

@endsection