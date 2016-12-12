<div class="modal fade dd-modal" id="create-artwork-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new piece of art</h4>
            </div>
            <form action="/admin/media/artworks" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">Title: </label>
                        @if($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                        <input type="text"
                               name="title"
                               placeholder="Give the artwork a title to get started"
                               value="{{ old('title') }}"
                               class="form-control">
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