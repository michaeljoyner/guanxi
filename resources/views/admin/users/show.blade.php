@extends('admin.base')

@section('content')
    <x-page-header :title="$user->name">
        <a href="/admin/users/{{ $user->id }}/edit" class="btn dd-btn btn-light mr-4">Edit</a>
        <delete-modal delete-url="/admin/users/{{ $user->id }}" item="{{ $user->name }}"></delete-modal>
    </x-page-header>

    <section class="users-show-page">
        <div class="p-4 shadow mb-12">
            <p class="text-lg mb-2"><strong>Level: </strong>{{ $user->role->type }}</p>
            <p class="text-lg mb-2"><strong>Email: </strong>{{ $user->email }}</p>
        </div>


        <a href="/admin/profiles/{{ $user->profile->id }}">
            <div class="flex p-4 shadow">
                <img class="block w-40 h-40 rounded-full" src="{{ $user->profile->avatar() }}" alt="{{ $user->profile->name }}">
                <div class="pl-8">
                    <p class="text-xl mb-6">{{ $user->profile->name }}</p>
                    <p class="">{{ $user->profile->intro }}</p>
                </div>
            </div>
        </a>
    </section>

@endsection

