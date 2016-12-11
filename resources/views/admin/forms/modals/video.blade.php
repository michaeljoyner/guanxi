<div class="modal fade dd-modal" id="create-video-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new video from Youtube or Vimeo</h4>
            </div>
            <form action="/admin/media/videos" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('video_url') ? ' has-error' : '' }}">
                        <label for="video_url">Video link: </label>
                        @if($errors->has('video_url'))
                            <span class="error-message">{{ $errors->first('video_url') }}</span>
                        @endif
                        <input type="text" name="video_url" value="{{ old('video_url') }}" class="form-control">
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