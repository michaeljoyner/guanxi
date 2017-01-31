<contact-form inline-template>
    <form action="" v-on:submit.prevent="submitForm" class="contact-form" :class="{'spent': spent}">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">{{ trans('about.contact.name_label') }}</label>
            @if($errors->has('name'))
                <span class="error-message">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" v-model="name" name="name" required value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">{{ trans('about.contact.email_label') }}</label>
            @if($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
            <input type="email" v-model="email" name="email" required value="{{ old('email') }}" class="form-control">
        </div>
        <div class="form-group{{ $errors->has('enquiry') ? ' has-error' : '' }}">
            <label for="enquiry">{{ trans('about.contact.enquiry_label') }}</label>
            @if($errors->has('enquiry'))
                <span class="error-message">{{ $errors->first('enquiry') }}</span>
            @endif
            <textarea name="enquiry" v-model="enquiry" required class="form-control">{{ old('enquiry') }}</textarea>
        </div>
        <div class="form-group submit-group">
            <transition name="slide-fade">
                <button v-show="!sending" type="submit" class="btn dd-btn block">{{ trans('about.contact.send_label') }}</button>
            </transition>
            <transition name="fade-in">
                <p v-show="sending" class="sending-message light-heading centered-text">{{ trans('about.contact.sending') }}</p>
            </transition>
        </div>
        <div class="success-panel">
            <p>{{ trans('about.contact.thanks') }}</p>
            <button class="dd-btn block" @click.stop.prevent=resetForm>{{ trans('about.contact.reset') }}</button>
        </div>
    </form>
</contact-form>