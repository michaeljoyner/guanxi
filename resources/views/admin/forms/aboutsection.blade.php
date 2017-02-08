<form action="/admin/pages/about/{{ $section }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has($section) ? ' has-error' : '' }}">
                <label for="{{ $section }}">{{ $section }}: </label>
                @if($errors->has('$section'))
                <span class="error-message">{{ $errors->first('$section') }}</span>
                @endif
                <textarea name="{{ $section }}" class="form-control" id="en_textarea">{{ old($section) ?? $enContent }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has( 'zh_' . $section) ? ' has-error' : '' }}">
                <label for="{{ 'zh_' . $section }}">{{ 'Chinese ' . $section }}: </label>
                @if($errors->has('zh_' . $section))
                <span class="error-message">{{ $errors->first('zh_' . $section) }}</span>
                @endif
                <textarea name="{{ 'zh_' . $section }}" class="form-control" id="zh_textarea">{{ old('zh_' . $section) ?? $zhContent }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>