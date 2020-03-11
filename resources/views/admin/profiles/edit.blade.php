@extends('admin.base')

@section('content')
    <x-page-header :title="$profile->name">
        <a href="/admin/profiles/{{ $profile->id }}" class="btn dd-btn btn-light">Back to Profile</a>
    </x-page-header>

    <section class="">
        @include('admin.forms.profile')
    </section>
@endsection

