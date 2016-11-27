@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $affiliate->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/affiliates/{{ $affiliate->id }}" class="btn dd-btn btn-light">Back to Affiliate</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.affiliate')
    </section>
@endsection

