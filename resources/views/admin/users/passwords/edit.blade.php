@extends('admin.base')

@section('content')
    <x-page-header title="Reset your password"></x-page-header>
    <div class="my-20 max-w-md mx-auto">
        @include('admin.forms.password')
    </div>

@endsection