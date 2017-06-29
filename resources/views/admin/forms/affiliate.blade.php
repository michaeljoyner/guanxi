<form action="/admin/affiliates/{{ $affiliate->id }}" method="POST" class="dd-form form-horizontal">
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name: </label>
                @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="name" value="{{ old('name') ?? $affiliate->name }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="location">Address: </label>
                @if($errors->has('location'))
                    <span class="error-message">{{ $errors->first('location') }}</span>
                @endif
                <input type="text" name="location" value="{{ old('location') ?? $affiliate->getTranslation('location', 'en') }}" class="form-control">
            </div>

            <div class="form-group{{ $errors->has('zh_location') ? ' has-error' : '' }}">
                <label for="zh_location">Chinese address: </label>
                @if($errors->has('zh_location'))
                    <span class="error-message">{{ $errors->first('zh_location') }}</span>
                @endif
                <input type="text" name="zh_location" value="{{ old('zh_location') ?? $affiliate->getTranslation('location', 'zh') }}" class="form-control">
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone">Phone number: </label>
                @if($errors->has('phone'))
                <span class="error-message">{{ $errors->first('phone') }}</span>
                @endif
                <input type="text" name="phone" value="{{ old('phone') ?? $affiliate->phone }}" class="form-control">
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
                    <input type="text" name="{{ $platform }}" value="{{ old($platform) ?? $affiliate->getSocialLink($platform) }}" class="form-control">
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group{{ $errors->has('writeup') ? ' has-error' : '' }}">
                <label for="writeup">Writeup: </label>
                @if($errors->has('writeup'))
                    <span class="error-message">{{ $errors->first('writeup') }}</span>
                @endif
                <textarea name="writeup" class="form-control dd-tall-textbox">{{ old('writeup') ?? $affiliate->getTranslation('writeup', 'en') }}</textarea>
            </div>
        </div>
        <div class="col-md-offset-2 col-md-5">
            <div class="form-group{{ $errors->has('zh_writeup') ? ' has-error' : '' }}">
                <label for="zh_writeup">Chinese writeup: </label>
                @if($errors->has('zh_writeup'))
                    <span class="error-message">{{ $errors->first('zh_writeup') }}</span>
                @endif
                <textarea name="zh_writeup" class="form-control dd-tall-textbox">{{ old('zh_writeup') ?? $affiliate->getTranslation('writeup', 'zh') }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn dd-btn">Save Changes</button>
    </div>
</form>