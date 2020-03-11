@extends('admin.base')

@section('content')
    <div class="h-screen w-full flex justify-center items-center">
        <form action="/admin/login" method="POST" class="max-w-md w-full">
            {!! csrf_field() !!}
            <h2 class="text-3xl">Welcome. Please login.</h2>
            @if(count($errors) > 0)
                <div class="alert-error-box">
                    @foreach($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="my-6">
                <label class="form-label" for="email">Email: </label>
                <input type="email" name="email" class="input-text" autofocus>
            </div>
            <div class="my-6">
                <label class="form-label" for="password">Password: </label>
                <input type="password" name="password" class="input-text">
            </div>
            <div class="flex justify-between">
                <div class="flex items-center">
                    <label class="form-label block mr-2" for="remember">Remember me:</label>
                    <input id="remember" type="checkbox" name="remember">
                </div>
                <a class="hover:underline text-gray-600" href="/admin/password/show/reset">Forgot Password?</a>
            </div>
            <div class="my-6">
                <button class="btn dd-btn btn-dark login-button" type="submit">Login</button>
            </div>
        </form>
    </div>

@endsection