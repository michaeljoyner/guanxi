<form method="POST" action="/admin/content/categories/{{ $category->id }}" class="">
    {!! csrf_field() !!}
    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="form-label" for="name"> English Name: </label>
                @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $category->getTranslation('name', 'en') }}"
                       class="input-text">
            </div>
            <div class="my-6{{ $errors->has('description') ? ' has-error' : '' }}">
                <label class="form-label" for="description">SEO Description: </label>
                @if($errors->has('description'))
                    <span class="error-message">{{ $errors->first('description') }}</span>
                @endif
                <textarea name="description" class="input-text h-40">{{ old('description') ?? $category->getTranslation('description', 'en') }}</textarea>
            </div>
        </div>
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('zh_name') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_name"> Chinese Name: </label>
                @if($errors->has('zh_name'))
                    <span class="error-message">{{ $errors->first('zh_name') }}</span>
                @endif
                <input type="text" name="zh_name" value="{{ old('zh_name') ?? $category->getTranslation('name', 'zh') }}"
                       class="input-text">
            </div>

            <div class="my-6{{ $errors->has('zh_description') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_description">Chinese SEO description: </label>
                @if($errors->has('zh_description'))
                    <span class="error-message">{{ $errors->first('zh_description') }}</span>
                @endif
                <textarea name="zh_description" class="input-text h-40">{{ old('zh_description') ?? $category->getTranslation('description', 'zh') }}</textarea>
            </div>
        </div>
    </div>

    <div class="my-6 flex justify-end px-6">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>