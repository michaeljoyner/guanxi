<form method="POST" action="/admin/users/{{ $user->id }}/password" class="dd-form form-horizontal form-narrow">
    {!! csrf_field() !!}
    @include('errors')
    <div class="form-group">
        <label for="current_password">Current password: </label>
        <input type="password" name="current_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">New Password: </label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm New Password: </label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Reset Password</button>
    </div>
</form>