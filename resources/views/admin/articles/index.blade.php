@extends('admin.base')

@section('content')
    <x-page-header title="Articles">
        <new-article></new-article>
    </x-page-header>


    <section class="">
            @foreach($articles as $article)
                <div class="flex bg-gray-100 border-b py-2">
                    <span class="flex-1 pl-4"><a class="text-lg hover:text-brand-purple" href="/admin/content/articles/{{ $article->id }}">{{ $article->title }}</a></span>
                    <span class="w-40 truncate">{{ $article->author->name }}</span>
                    <span class="w-40 truncate">{{ $article->published ? 'Published' : 'Unpublished' }}</span>
                </div>
            @endforeach
    </section>
    <div class="flex my-12">
        <span class="mr-4">Pages:</span>
        @foreach(range(1,$articles->lastPage()) as $page)
            <a class="hover:underline text-brand-purple mr-4"
               href="{{ $articles->url($page) }}">{{ $page }}</a>
        @endforeach
    </div>
@endsection