<form action="/admin/profiles/{{ $profile->id }}" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name: </label>
                @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $profile->name }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title">Title: </label>
                @if($errors->has('title'))
                    <span class="error-message">{{ $errors->first('title') }}</span>
                @endif
                <input type="text" name="title" value="{{ old('title') ?? $profile->getTranslation('title', 'en') }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('zh_title') ? ' has-error' : '' }}">
                <label for="zh_title">Chinese title: </label>
                @if($errors->has('zh_title'))
                    <span class="error-message">{{ $errors->first('zh_title') }}</span>
                @endif
                <input type="text" name="zh_title" value="{{ old('zh_title') ?? $profile->getTranslation('title', 'zh') }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
                <label for="intro">Intro: </label>
                @if($errors->has('intro'))
                    <span class="error-message">{{ $errors->first('intro') }}</span>
                @endif
                <textarea name="intro" class="form-control">{{ old('intro') ?? $profile->getTranslation('intro', 'en') }}</textarea>
            </div>
            <div class="form-group{{ $errors->has('zh_intro') ? ' has-error' : '' }}">
                <label for="zh_intro">Chinese intro: </label>
                @if($errors->has('zh_intro'))
                    <span class="error-message">{{ $errors->first('zh_intro') }}</span>
                @endif
                <textarea name="zh_intro" class="form-control">{{ old('zh_intro') ?? $profile->getTranslation('intro', 'zh') }}</textarea>
            </div>


        </div>
        <div class="col-md-5 col-md-offset-1">
            <h4 class="text-uppercase text-center">Social links</h4>
            <small class="text-danger text-center">Only enter social links or your email if you want them to be public.</small>
            @foreach($social_platforms as $platform)
                <div class="form-group{{ $errors->has($platform) ? ' has-error' : '' }}">
                    <label for="{{ $platform }}">{{ ucfirst($platform) }}: </label>
                    @if($errors->has($platform))
                    <span class="error-message">{{ $errors->first($platform) }}</span>
                    @endif
                    <input type="text" name="{{ $platform }}" value="{{ old($platform) ?? $profile->getSocialLink($platform) }}" class="form-control">
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                <label for="bio">Bio: </label>
                @if($errors->has('bio'))
                    <span class="error-message">{{ $errors->first('bio') }}</span>
                @endif
                <textarea name="bio" class="form-control dd-tall-textbox">{{ old('bio') ?? $profile->getTranslation('bio', 'en') }}</textarea>
            </div>
        </div>
        <div class="col-md-offset-2 col-md-5">
            <div class="form-group{{ $errors->has('zh_bio') ? ' has-error' : '' }}">
                <label for="zh_bio">Chinese bio: </label>
                @if($errors->has('zh_bio'))
                    <span class="error-message">{{ $errors->first('zh_bio') }}</span>
                @endif
                <textarea name="zh_bio" class="form-control dd-tall-textbox">{{ old('zh_bio') ?? $profile->getTranslation('bio', 'zh') }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>