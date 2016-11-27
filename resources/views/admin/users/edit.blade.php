@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $user->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/users/{{ $user->id }}" class="btn dd-btn btn-light">Back to User</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        <form action="/admin/users/{{ $user->id }}" class="dd-form form-horizontal" method="POST">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name: </label>
                @if($errors->has('name'))
                <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email: </label>
                @if($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
                <input type="email" name="email" value="{{ old('email') ?? $user->email }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">User Role: </label>
                <div class="user-roles">
                    @foreach($roles as $role)
                        <input class="dd-labelled-checkbox"
                               type="radio"
                               id="{{ $role->type }}"
                               name="role_id"
                               value="{{ $role->id }}"
                               @if(old('role_id') === $role->id || $user->role->id === $role->id) checked @endif
                        >
                        <label for="{{ $role->type }}" class="dd-checkbox-label">
                            {{ $role->type }}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn dd-btn btn-dark">Save Changes</button>
            </div>
        </form>
    </section>
@endsection

