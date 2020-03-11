@extends('admin.base')

@section('content')
    <x-page-header title="Categories">
        <new-category></new-category>
    </x-page-header>

    <section>
        @foreach($categories as $category)
            <a href="/admin/content/categories/{{ $category->id }}">
                <div class="flex justify-between bg-eggshell my-8">
                    <div class="w-40 h-32">
                        <img src="{{ $category->imageSrc('thumb') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 px-8 py-4">
                        <h3 class="text-xl mb-6">{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </section>

@endsection