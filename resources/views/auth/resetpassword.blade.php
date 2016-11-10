@extends('admin.base')

@section('content')
    <div class="password-reset-header">
        <h2>Forgotten your password?</h2>
        <p class="help-text">Enter your email address and we will send you an email to help you reset your password.</p>
    </div>
    <form class="password-form dd-form form-horizontal form-narrow"
          role="form"
          method="POST"
          action="{{ url('/admin/password/email') }}"
    >
        {{ csrf_field() }}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Email: </label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
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
@endsection