<div class="modal fade dd-modal" id="create-category-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create a new Content Category</h4>
            </div>
            <form action="/admin/content/categories" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name"> English Name: </label>
                        @if($errors->has('name'))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('zh_name') ? ' has-error' : '' }}">
                        <label for="zh_name"> Chinese Name: </label>
                        @if($errors->has('zh_name'))
                            <span class="error-message">{{ $errors->first('zh_name') }}</span>
                        @endif
                        <input type="text" name="zh_name" value="{{ old('zh_name') }}" class="form-control">
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description: </label>
                        @if($errors->has('description'))
                        <span class="error-message">{{ $errors->first('description') }}</span>
                        @endif
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group{{ $errors->has('zh_description') ? ' has-error' : '' }}">
                        <label for="zh_description">Chinese description: </label>
                        @if($errors->has('zh_description'))
                        <span class="error-message">{{ $errors->first('zh_description') }}</span>
                        @endif
                        <textarea name="zh_description" class="form-control">{{ old('zh_description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dd-btn btn-light dd-modal-cancel-btn" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn dd-btn dd-modal-confirm-btn">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->