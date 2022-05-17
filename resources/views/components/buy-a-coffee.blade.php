<div class="flex flex-col items-center p-8 my-12">
    @if($useSupportMessage)
        <p class="mt-3 type-b5 mb-6 {{ $supportMessageClasses() }}">{{ trans('buy-me-a-coffee.support') }}</p>
    @endif
    <div class="flex flex-col md:flex-row justify-center items-center">
        <a class="{{ $buttonType('bg-sunny-yellow hover:bg-yellow-400') }} flex md:mr-3"
           target="_blank"
           rel="nofollow"
           href="https://buymeacoffee.com/GuanXiMedia">
            @include('svgicons.coffee', ['classes' => 'w-6 h-6 mr-2 ' . $svgColour()])
            <span>{{ trans('buy-me-a-coffee.button') }}</span>
        </a>


        <a href="https://www.patreon.com/bePatron?u=68952652"
           class="{{ $buttonType('bg-patreon-red hover:bg-primary-red') }} flex  mt-6 md:ml-3 md:mt-0"
           target="_blank"
           rel="nofollow"
        >
            @include('svgicons.patreon', ['classes' => 'w-6 h-6 mr-2 ' . $svgColour()])
            <span>Become a Patron!</span>
        </a>

    </div>
</div>
