@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $profile->name }}</h1>
        <div class="header-actions pull-right">
            @if(! $profile->hasUser())
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-user-modal">
                Make into User
            </button>
                @include('admin.partials.deletebutton', [
                'deleteFormAction' => '/admin/profiles/' . $profile->id,
                'objectName' => $profile->name
            ])
            @else
                <a href="/admin/users/{{ $profile->user_id }}" class="btn dd-btn btn-dark">User Page</a>
            @endif
            <a href="/admin/profiles/{{ $profile->id }}/edit" class="btn dd-btn btn-light">Edit</a>
        </div>
    </section>
    <section class="profile-show-page">
        <div class="row">
            <div class="col-md-6">
                <p class="text-uppercase">
                    {{ $profile->getTranslation('title', 'en') }} {{ $profile->getTranslation('title', 'zh') }}
                </p>
                <p class="field-label">Intro</p>
                <p>{{ $profile->getTranslation('intro', 'en') }}</p>
                <p class="field-label">Chinese Intro</p>
                <p>{{ $profile->getTranslation('intro', 'zh') }}</p>
            </div>
            <div class="col-md-6">
                <div class="single-image-uploader-box">
                    <single-upload default="{{ $profile->avatar('thumb') }}"
                                   url="/admin/profiles/{{ $profile->id }}/avatar"
                                   shape="round"
                                   size="large"
                    ></single-upload>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="field-label">Bio</p>
                <p>{{ $profile->getTranslation('bio', 'en') }}</p>
            </div>
            <div class="col-md-6">
                <p class="field-label">Bio</p>
                <p>{{ $profile->getTranslation('bio', 'zh') }}</p>
            </div>
        </div>
    </section>
    @include('admin.forms.modals.usermodal', [
            'profile_name' => $profile->name,
            'form_action' => '/admin/profiles/' . $profile->id . '/user'
    ])
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection