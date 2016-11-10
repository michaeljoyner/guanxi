@extends('admin.base')

@section('content')
    <div class="password-reset-header">
        <h2>Reset Your Password</h2>
        <p>To complete the password reset process enter your email and choose a new password.</p>
    </div>
    <form class="password-form dd-form form-narrow form-horizontal"
          role="form"
          method="POST"
          action="{{ url('/admin/password/reset') }}"
    >
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Email:</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required
                   autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="control-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button control dd-btn btn btn-dark form-button">
                Reset Password
            </button>
        </div>
    </form>
@endsection