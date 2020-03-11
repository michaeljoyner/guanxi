<form action="/admin/pages/about/{{ $section }}" method="POST">
    {!! csrf_field() !!}
    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has($section) ? ' has-error' : '' }}">
                <label class="form-label" for="{{ $section }}">{{ $section }}: </label>
                @if($errors->has('$section'))
                <span class="error-message">{{ $errors->first('$section') }}</span>
                @endif
                <textarea name="{{ $section }}" class="input-text" id="en_textarea">{{ old($section) ?? $enContent }}</textarea>
            </div>
        </div>
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has( 'zh_' . $section) ? ' has-error' : '' }}">
                <label class="form-label" for="{{ 'zh_' . $section }}">{{ 'Chinese ' . $section }}: </label>
                @if($errors->has('zh_' . $section))
                <span class="error-message">{{ $errors->first('zh_' . $section) }}</span>
                @endif
                <textarea name="{{ 'zh_' . $section }}" class="input-text" id="zh_textarea">{{ old('zh_' . $section) ?? $zhContent }}</textarea>
            </div>
        </div>
    </div>
    <div class="px-6 my-8 flex justify-end">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>