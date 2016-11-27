@extends('admin.base')

@section('content')
    <form action="/admin/login" method="POST" class=" login-form dd-form form-narrow form-horizontal">
        {!! csrf_field() !!}
        <h2>Welcome, Login</h2>
        @if(count($errors) > 0)
            <div class="alert-error-box">
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control" autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="secondary-login-options">
            <div class="remember-me">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember" class="remember-label">Remember me:</label>
            </div>
            <a class="forgot-password" href="/admin/password/show/reset">Forgot Password?</a>
        </div>
        <div class="form-group">
            <button class="btn dd-btn btn-dark login-button" type="submit">Login</button>
        </div>
    </form>
@endsection