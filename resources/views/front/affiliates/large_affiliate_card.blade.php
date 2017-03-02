<div class="large-affiliate-card two-piece">
    <p class="affiliate-name purple-text heavy-heading">{{ $affiliate->name }}</p>
    <a href="{{ localUrl('/affiliates/' . $affiliate->slug) }}">
        <div class="card-image-holder">
            <img src="{{ $affiliate->imageSrc('web') }}" width="500" height="400" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.affiliates.hover_text') }}</p>
        </div>
    </a>
    <p class="affiliate-address light-heading">{{ $affiliate->location }}</p>
    <p class="affiliate-website"><a href="{{ $affiliate->website }}">{{ $affiliate->website }}</a></p>
</div>