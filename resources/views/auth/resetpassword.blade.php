@extends('admin.base')

@section('content')
    <div class="w-full h-screen flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="password-reset-header">
                <h2 class="text-4xl">Forgotten your password?</h2>
                <p class="my-12">Enter your email address and we will send you an email to help you reset your password.</p>
            </div>
            <form class=""
                  role="form"
                  method="POST"
                  action="{{ url('/admin/password/email') }}"
            >
                {{ csrf_field() }}
                @if (session('status'))
                    <div class="p-4 rounded bg-brand-soft-purple text-white">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="my-8 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="form-label">Email: </label>
                    <input id="email" type="email" class="input-text" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class=" btn dd-btn btn-dark control form-button">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection