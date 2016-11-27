@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $user->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/users/{{ $user->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'deleteFormAction' => '/admin/users/' . $user->id,
                'objectName' => $user->name
            ])
        </div>
    </section>
    <section class="users-show-page">
        <p class="lead"><strong>Level: </strong>{{ $user->role->type }}</p>
        <p class="lead"><strong>Email: </strong>{{ $user->email }}</p>

        <a href="/admin/profiles/{{ $user->profile->id }}">
            <div class="profile-intro-card">
                <div class="profile-intro-card-avatar-box">
                    <img src="{{ $user->profile->avatar() }}" alt="{{ $user->profile->name }}">
                </div>
                <div class="profile-intro-card-text-box">
                    <p class="profile-intro-card-name">{{ $user->profile->name }}</p>
                    <p class="profile-intro-card-intro">{{ $user->profile->intro }}</p>
                </div>
            </div>
        </a>
    </section>

    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection