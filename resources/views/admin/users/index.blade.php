@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Users</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-user-modal">
                New User
            </button>
        </div>
    </section>
    <section class="users-listing">
        @foreach($users as $user)
        <a href="/admin/users/{{ $user->id }}">
            <div class="user-index-card">
                <h4>{{ $user->name }}</h4>
            </div>
        </a>
        @endforeach
    </section>
    @include('admin.forms.modals.usermodal')
@endsection

@section('bodyscripts')

@endsection