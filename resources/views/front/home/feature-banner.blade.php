<div class="flex justify-between relative">
    <div class="w-full md:w-1/3 bg-opaque-black md:bg-black p-6">
        <div class="h-full border-t-4 border-b-4 border-white py-6 flex flex-col justify-between">
            <p class="type-h1 uppercase text-white">
                {{ $feature['title'] }}
            </p>
            <div class="flex justify-center  mt-8">
                <a href="{{ $feature['link'] }}" class="border-4 border-white text-white type-h3 px-6 py-2">{{ $feature['button_text'] }}</a>
            </div>
        </div>

    </div>
    <div class="flex-1 order-1 md:order-2">
        <div style="padding-bottom: 56.25%;" class="static md:relative">
            <img src="{{ $feature['image'] }}" class="w-full h-full object-cover absolute inset-0" style="z-index: -1;"
                 alt="">
        </div>

    </div>
</div>