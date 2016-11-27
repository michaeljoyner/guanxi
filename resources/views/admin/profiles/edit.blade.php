@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $profile->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/profiles/{{ $profile->id }}" class="btn dd-btn btn-light">Back to Profile</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.profile')
    </section>
@endsection

