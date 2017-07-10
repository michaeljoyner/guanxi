@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Guanxi Contributors</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-profile-modal">
                Add Contributor
            </button>
        </div>
    </section>
    <section class="profiles-index">
    @foreach($profiles as $profile)
        <div class="profile-index-card">
            <a href="/admin/profiles/{{ $profile->id }}">
                <p class="h5 text-uppercase text-center">{{ $profile->name }}</p>
                <img src="{{ $profile->avatar('thumb') }}" alt="" class="img-circle">
            </a>
            <p class="h6 text-uppercase text-center">{{ $profile->title ? $profile->title : '?' }}</p>
            <toggle-switch identifier="{{ $profile->id }}"
                           true-label="Public"
                           false-label="Private"
                           :initial-state="{{ $profile->published ? 'true' : 'false' }}"
                           toggle-url="/admin/profiles/{{ $profile->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
        </div>
    @endforeach
    </section>
    @include('admin.forms.modals.profile')
@endsection

