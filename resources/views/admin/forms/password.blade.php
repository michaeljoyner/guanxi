<form method="POST" action="/admin/users/{{ $user->id }}/password" class="">
    {!! csrf_field() !!}
    @include('errors')
    <div class="my-6">
        <label class="form-label" for="current_password">Current password: </label>
        <input type="password" value="{{ old('password') }}" name="current_password" class="input-text">
    </div>
    <div class="my-6">
        <label class="form-label" for="password">New Password: </label>
        <input type="password" name="password" class="input-text">
    </div>
    <div class="my-6">
        <label class="form-label" for="password_confirmation">Confirm New Password: </label>
        <input type="password" name="password_confirmation" class="input-text">
    </div>
    <div class="my-6">
        <button type="submit" class="btn dd-btn">Reset Password</button>
    </div>
</form>