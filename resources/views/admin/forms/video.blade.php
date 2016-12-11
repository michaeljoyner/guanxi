<form method="POST" action="/admin/media/videos/{{ $video->id }}" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title">Title: </label>
        @if($errors->has('title'))
        <span class="error-message">{{ $errors->first('title') }}</span>
        @endif
        <input type="text" name="title" value="{{ old('title') ?? $video->getTranslation('title', 'en') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('zh_title') ? ' has-error' : '' }}">
        <label for="zh_title">Chinese title: </label>
        @if($errors->has('zh_title'))
        <span class="error-message">{{ $errors->first('zh_title') }}</span>
        @endif
        <input type="text" name="zh_title" value="{{ old('zh_title') ?? $video->getTranslation('title', 'zh') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description">Description: </label>
        @if($errors->has('description'))
        <span class="error-message">{{ $errors->first('description') }}</span>
        @endif
        <textarea name="description" class="form-control dd-tall-textbox">{{ old('description') ?? $video->getTranslation('description', 'en') }}</textarea>
    </div>
    <div class="form-group{{ $errors->has('zh_description') ? ' has-error' : '' }}">
        <label for="zh_description">Chinese description: </label>
        @if($errors->has('zh_description'))
        <span class="error-message">{{ $errors->first('zh_description') }}</span>
        @endif
        <textarea name="zh_description" class="form-control dd-tall-textbox">{{ old('zh_description') ?? $video->getTranslation('description', 'zh') }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>