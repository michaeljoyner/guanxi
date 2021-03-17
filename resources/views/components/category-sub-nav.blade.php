<div class="my-3 py-2 px-6 border-t-2 border-b-2 border-mid-grey">
    <div class="max-w-full w-full flex justify-start md:justify-center overflow-x-auto">
        @foreach($categories as $category)
                <a class="type-h3 text-text-grey hover:text-black whitespace-no-wrap uppercase mr-8 md:mr-12" href="{{ $category['url'] }}">{{ $category['title'] }}</a>
        @endforeach
    </div>
</div>