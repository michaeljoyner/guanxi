@extends('admin.base')

@section('content')
    <x-page-header title="Users">
        <new-user :roles='@json($roles)'></new-user>
    </x-page-header>

    <section class="pb-32">
        @foreach($users as $user)
        <a href="/admin/users/{{ $user->id }}">
            <div class="my-4 shadow p-4 flex items-center">
                <img src="{{ $user->profile->avatar() }}" class="h-12 w-12 rounded-full mr-8">
                <h4>{{ $user->name }}</h4>
            </div>
        </a>
        @endforeach
    </section>
@endsection

