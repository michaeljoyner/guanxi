<div class="modal fade dd-modal" id="create-article-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Begin a new Article</h4>
            </div>
            <form action="/admin/content/articles" method="POST" class="modal-form dd-form form-horizontal">
                <div class="modal-body">

                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">Article Title: </label>
                        @if($errors->has('title'))
                            <span class="error-message">{{ $errors->first('title') }}</span>
                        @endif
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">This title is in: </label>
                        <div class="language-choice">
                                <input class="dd-labelled-checkbox"
                                       type="radio"
                                       id="english-locale"
                                       name="lang"
                                       value="en"
                                       checked
                                >
                                <label for="english-locale" class="dd-checkbox-label">
                                    English
                                </label>
                            <input class="dd-labelled-checkbox"
                                   type="radio"
                                   id="chinese-locale"
                                   name="lang"
                                   value="en"
                            >
                            <label for="chinese-locale" class="dd-checkbox-label">
                                Chinese
                            </label>
                        </div>
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