<div class="modal fade dd-modal" id="create-user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register a new User</h4>
            </div>
            <form action="{{ $form_action ?? "/admin/users" }}" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name"> English Name: </label>
                        @if($errors->has('name'))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" name="name" value="{{ old('name') ?? $profile_name ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('zh_name') ? ' has-error' : '' }}">
                        <label for="zh_name"> Chinese Name: </label>
                        @if($errors->has('zh_name'))
                            <span class="error-message">{{ $errors->first('zh_name') }}</span>
                        @endif
                        <input type="text" name="zh_name" value="{{ old('zh_name') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email: </label>
                        @if($errors->has('email'))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                        @endif
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
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
                                       @if($loop->last) checked @endif
                                >
                                <label for="{{ $role->type }}" class="dd-checkbox-label">
                                    {{ $role->type }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password: </label>
                        @if($errors->has('password'))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                        @endif
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation">Confirm Password: </label>
                        @if($errors->has('password_confirmation'))
                            <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                               class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dd-btn btn-light dd-modal-cancel-btn" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn dd-btn dd-modal-confirm-btn">Register</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->