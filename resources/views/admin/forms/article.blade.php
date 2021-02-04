<form action="/admin/content/articles/{{ $article->id }}" method="POST" class="">
    {!! csrf_field() !!}
    <div class="px-6">
        <p class="uppercase mb-4">Taiwan or World?</p>
        <div class="flex justify-between max-w-xs">
            <div>
                <label for="designation_taiwan">
                    <span>Taiwan</span>
                    <input @if($article->designation === 'taiwan') checked @endif name="designation" type="radio" value="taiwan" id="designation_taiwan">
                </label>
            </div>

            <div>
                <label for="designation_world">
                    <span>World</span>
                    <input @if($article->designation === 'world') checked @endif name="designation" type="radio" value="world" id="designation_world">
                </label>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="form-label" for="title">Title: </label>
                @if($errors->has('title'))
                    <span class="error-message">{{ $errors->first('title') }}</span>
                @endif
                <input type="text" name="title" value="{{ old('title') ?? $article->getTranslation('title', 'en') }}" class="input-text">
            </div>
            <counting-textarea :char_limit="180"
                               :has-error="{{ $errors->has('description') ? 'true' : 'false' }}"
                               label="Description"
                               initial-value="{{ old('description') ?? $article->getTranslation('description', 'en')}}"
                               field-name="description"
                               error-message="{{ $errors->first('description') }}"
            ></counting-textarea>
        </div>
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('zh_title') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_title">Chinese title: </label>
                @if($errors->has('zh_title'))
                    <span class="error-message">{{ $errors->first('zh_title') }}</span>
                @endif
                <input type="text" name="zh_title" value="{{ old('zh_title') ?? $article->getTranslation('title', 'zh') }}" class="input-text">
            </div>

            <div class="my-6{{ $errors->has('zh_description') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_description">Chinese description: </label>
                @if($errors->has('zh_description'))
                    <span class="error-message">{{ $errors->first('zh_description') }}</span>
                @endif
                <textarea name="zh_description" class="input-text h-32">{{ old('zh_description') ?? $article->getTranslation('description', 'zh') }}</textarea>
            </div>
        </div>
    </div>

    <div class="my-6 px-6 flex justify-end">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>