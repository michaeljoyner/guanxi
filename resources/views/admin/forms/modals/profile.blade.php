<div class="modal fade dd-modal" id="create-profile-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Profile for a Guanxi Contributor</h4>
            </div>
            <form action="/admin/profiles" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name: </label>
                        @if($errors->has('name'))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="zh_name">Person's title/role: </label>
                        @if($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
                        <label for="intro">Intro: </label>
                        @if($errors->has('intro'))
                        <span class="error-message">{{ $errors->first('intro') }}</span>
                        @endif
                        <textarea name="intro" class="form-control">{{ old('intro') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dd-btn btn-light dd-modal-cancel-btn" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn dd-btn dd-modal-confirm-btn">Add Profile</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->