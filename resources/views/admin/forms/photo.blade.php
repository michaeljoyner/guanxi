<form method="POST" action="/admin/media/photos/{{ $photo->id }}" class="">

    {!! csrf_field() !!}

    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-4{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="form-label" for="title">Title: </label>
                @if($errors->has('title'))
                    <span class="error-message">{{ $errors->first('title') }}</span>
                @endif
                <input type="text" name="title" value="{{ old('title') ?? $photo->getTranslation('title', 'en') }}" class="input-text">
            </div>
            <div class="my-4{{ $errors->has('description') ? ' has-error' : '' }}">
                <label class="form-label" for="description">Description: </label>
                @if($errors->has('description'))
                    <span class="error-message">{{ $errors->first('description') }}</span>
                @endif
                <textarea name="description" class="input-text h-64">{{ old('description') ?? $photo->getTranslation('description', 'en') }}</textarea>
            </div>
        </div>
        <div class="w-1/2 px-6">
            <div class="my-4{{ $errors->has('zh_title') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_title">Chinese title: </label>
                @if($errors->has('zh_title'))
                    <span class="error-message">{{ $errors->first('zh_title') }}</span>
                @endif
                <input type="text" name="zh_title" value="{{ old('zh_title') ?? $photo->getTranslation('title', 'zh') }}" class="input-text">
            </div>

            <div class="my-4{{ $errors->has('zh_description') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_description">Chinese description: </label>
                @if($errors->has('zh_description'))
                    <span class="error-message">{{ $errors->first('zh_description') }}</span>
                @endif
                <textarea name="zh_description" class="input-text h-64">{{ old('zh_description') ?? $photo->getTranslation('description', 'zh') }}</textarea>
            </div>
        </div>
    </div>


    <div class="my-4 px-6 justify-end flex">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>