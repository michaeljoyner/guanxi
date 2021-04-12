<div class="flex flex-col items-center p-8 my-12">
    <a class="{{ $buttonType() }} flex" target="_blank" rel="nofollow" href="https://buymeacoffee.com/GuanXiMedia">
        @include('svgicons.coffee', ['classes' => 'w-6 h-6 mr-2 ' . $svgColour()])
        <span>{{ trans('buy-me-a-coffee.button') }}</span>
    </a>
    @if($useSupportMessage)
    <p class="mt-3 type-b5 {{ $supportMessageClasses() }}">{{ trans('buy-me-a-coffee.support') }}</p>
    @endif
</div>
