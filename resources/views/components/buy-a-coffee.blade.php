<div class="flex flex-col items-center p-8 my-12">
    <a class="{{ $buttonType() }} flex" target="_blank" rel="nofollow" href="https://buymeacoffee.com/GuanXiMedia">
        @include('svgicons.beer', ['classes' => 'w-6 mr-2 ' . $svgColour()])
        <span>Buy us a beer</span>
    </a>
    @if($useSupportMessage)
    <p class="mt-3 type-b5 {{ $supportMessageClasses() }}">Help support Guanxi Media</p>
    @endif
</div>