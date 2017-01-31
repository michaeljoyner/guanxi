<form action="/admin/content/articles/{{ $article->id }}" method="POST" class="form-horizontal dd-form">
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title">Title: </label>
        @if($errors->has('title'))
        <span class="error-message">{{ $errors->first('title') }}</span>
        @endif
        <input type="text" name="title" value="{{ old('title') ?? $article->getTranslation('title', 'en') }}" class="form-control">
    </div>
    <div class="form-group{{ $errors->has('zh_title') ? ' has-error' : '' }}">
        <label for="zh_title">Chinese title: </label>
        @if($errors->has('zh_title'))
        <span class="error-message">{{ $errors->first('zh_title') }}</span>
        @endif
        <input type="text" name="zh_title" value="{{ old('zh_title') ?? $article->getTranslation('title', 'zh') }}" class="form-control">
    </div>
    {{--<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">--}}
        {{--<label for="description">Description: </label>--}}
        {{--@if($errors->has('description'))--}}
        {{--<span class="error-message">{{ $errors->first('description') }}</span>--}}
        {{--@endif--}}
        {{--<textarea name="description" class="form-control">{{ old('description') ?? $article->getTranslation('description', 'en')}}</textarea>--}}
    {{--</div>--}}
    <counting-textarea :char_limit="180"
                       :has-error="{{ $errors->has('description') ? 'true' : 'false' }}"
                       label="Description"
                       initial-value="{{ old('description') ?? $article->getTranslation('description', 'en')}}"
                       field-name="description"
                       error-message="{{ $errors->first('description') }}"
    ></counting-textarea>
    <div class="form-group{{ $errors->has('zh_description') ? ' has-error' : '' }}">
        <label for="zh_description">Chinese description: </label>
        @if($errors->has('zh_description'))
        <span class="error-message">{{ $errors->first('zh_description') }}</span>
        @endif
        <textarea name="zh_description" class="form-control">{{ old('zh_description') ?? $article->getTranslation('description', 'zh') }}</textarea>
    </div>
    {{--<counting-textarea :char_limit="180"--}}
                       {{--:has-error="{{ $errors->has('zh_description') ? 'true' : 'false' }}"--}}
                       {{--label="Chinese description"--}}
                       {{--initial-value="{{ old('zh_description') ?? $article->getTranslation('description', 'zh')}}"--}}
                       {{--field-name="zh_description"--}}
                       {{--error-message="{{ $errors->first('zh_description') }}"--}}
    {{--></counting-textarea>--}}
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>