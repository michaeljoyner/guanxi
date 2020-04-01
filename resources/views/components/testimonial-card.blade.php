<div class="max-w-xl relative p-8 {{ $baseMargin }}">
    <img src="{{ $testimonial['avatar'] }}"
         alt="{{ $testimonial['name'] }}"
         class="absolute top-0 h-16 w-16 rounded-full border-2 border-brand-purple {{ $imageClasses }}">
    <div class="type-b1 py-6 bg-gray-100 rounded shadow {{ $contentClasses }}">
        <p>{{ $testimonial['content'] }}</p>
        <p class="italic mt-4 {{ $nameClasses }}">&dash; {{ $testimonial['name'] }}</p>
    </div>

</div>