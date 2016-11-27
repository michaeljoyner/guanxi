<form method="POST" action="/admin/content/categories/{{ $category->id }}" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name"> English Name: </label>
        @if($errors->has('name'))
            <span class="error-message">{{ $errors->first('name') }}</span>
        @endif
        <input type="text" name="name" value="{{ old('name') ?? $category->getTranslation('name', 'en') }}"
               class="form-control">
    </div>
    <div class="form-group{{ $errors->has('zh_name') ? ' has-error' : '' }}">
        <label for="zh_name"> Chinese Name: </label>
        @if($errors->has('zh_name'))
            <span class="error-message">{{ $errors->first('zh_name') }}</span>
        @endif
        <input type="text" name="zh_name" value="{{ old('zh_name') ?? $category->getTranslation('name', 'zh') }}"
               class="form-control">
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description">Description: </label>
        @if($errors->has('description'))
            <span class="error-message">{{ $errors->first('description') }}</span>
        @endif
        <textarea name="description" class="form-control">{{ old('description') ?? $category->getTranslation('description', 'en') }}</textarea>
    </div>
    <div class="form-group{{ $errors->has('zh_description') ? ' has-error' : '' }}">
        <label for="zh_description">Chinese description: </label>
        @if($errors->has('zh_description'))
            <span class="error-message">{{ $errors->first('zh_description') }}</span>
        @endif
        <textarea name="zh_description" class="form-control">{{ old('zh_description') ?? $category->getTranslation('description', 'zh') }}</textarea>
    </div>
    <div class="form-group{{ $errors->has('writeup') ? ' has-error' : '' }}">
        <label for="writeup">Write up: </label>
        @if($errors->has('writeup'))
            <span class="error-message">{{ $errors->first('writeup') }}</span>
        @endif
        <textarea name="writeup" class="form-control">{{ old('writeup') ?? $category->getTranslation('writeup', 'en') }}</textarea>
    </div>
    <div class="form-group{{ $errors->has('zh_writeup') ? ' has-error' : '' }}">
        <label for="zh_writeup">Chinese write up: </label>
        @if($errors->has('zh_writeup'))
            <span class="error-message">{{ $errors->first('zh_writeup') }}</span>
        @endif
        <textarea name="zh_writeup" class="form-control">{{ old('zh_writeup') ?? $category->getTranslation('writeup', 'zh') }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>