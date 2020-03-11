<form action="/admin/profiles/{{ $profile->id }}" method="POST" class="">
    {!! csrf_field() !!}
    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="form-label" for="name">Name: </label>
                @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $profile->name }}" class="input-text">
            </div>
            <div class="my-6{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="form-label" for="title">Title: </label>
                @if($errors->has('title'))
                    <span class="error-message">{{ $errors->first('title') }}</span>
                @endif
                <input type="text" name="title" value="{{ old('title') ?? $profile->getTranslation('title', 'en') }}" class="input-text">
            </div>
            <div class="my-6{{ $errors->has('zh_title') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_title">Chinese title: </label>
                @if($errors->has('zh_title'))
                    <span class="error-message">{{ $errors->first('zh_title') }}</span>
                @endif
                <input type="text" name="zh_title" value="{{ old('zh_title') ?? $profile->getTranslation('title', 'zh') }}" class="input-text">
            </div>
            <counting-textarea :char_limit="180"
                               class="my-6"
                               :has-error="{{ $errors->has('description') ? 'true' : 'false' }}"
                               label="Intro"
                               initial-value="{{ old('intro') ?? $profile->getTranslation('intro', 'en')}}"
                               field-name="intro"
                               error-message="{{ $errors->first('intro') }}"
            ></counting-textarea>
            <div class="my-6{{ $errors->has('zh_intro') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_intro">Chinese intro: </label>
                @if($errors->has('zh_intro'))
                    <span class="error-message">{{ $errors->first('zh_intro') }}</span>
                @endif
                <textarea name="zh_intro" class="input-text h-32">{{ old('zh_intro') ?? $profile->getTranslation('intro', 'zh') }}</textarea>
            </div>


        </div>
        <div class="w-1/2 px-6">
            <h4 class="text-uppercase text-center">Social links</h4>
            <small class="text-danger text-center">Only enter social links or your email if you want them to be public.</small>
            @foreach($social_platforms as $platform)
                <div class="my-6{{ $errors->has($platform) ? ' has-error' : '' }}">
                    <label class="form-label" for="{{ $platform }}">{{ ucfirst($platform) }}: </label>
                    @if($errors->has($platform))
                    <span class="error-message">{{ $errors->first($platform) }}</span>
                    @endif
                    <input type="text" name="{{ $platform }}" value="{{ old($platform) ?? $profile->getSocialLink($platform) }}" class="input-text">
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="flex justify-between">
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('bio') ? ' has-error' : '' }}">
                <label class="form-label" for="bio">Bio: </label>
                @if($errors->has('bio'))
                    <span class="error-message">{{ $errors->first('bio') }}</span>
                @endif
                <textarea name="bio" class="input-text h-64">{{ old('bio') ?? $profile->getTranslation('bio', 'en') }}</textarea>
            </div>
        </div>
        <div class="w-1/2 px-6">
            <div class="my-6{{ $errors->has('zh_bio') ? ' has-error' : '' }}">
                <label class="form-label" for="zh_bio">Chinese bio: </label>
                @if($errors->has('zh_bio'))
                    <span class="error-message">{{ $errors->first('zh_bio') }}</span>
                @endif
                <textarea name="zh_bio" class="input-text h-64">{{ old('zh_bio') ?? $profile->getTranslation('bio', 'zh') }}</textarea>
            </div>
        </div>
    </div>
    <div class="my-6 px-6 flex justify-end">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>