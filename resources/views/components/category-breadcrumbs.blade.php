<div class="my-2 py-1 px-6 border-black">
    <div class="flex items-center justify-start text-text-grey">
        <a href="{{ localUrl('/articles') }}" class="hover:text-black">Articles</a>
        @if($designation)
        <span class="mx-4">&gt;</span>
        <a href="{{ $designationLink() }}" class="hover:text-black capitalize">{{ $designationText() }}</a>
        @endif
        <span class="mx-4">&gt;</span>
        <span>{{ $category }}</span>
    </div>

</div>