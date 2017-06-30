<div class="affiliate-card four-piece">
    <a href="{{ localUrl('/affiliates/' . $affiliate->slug) }}">
        <div class="card-image-holder">
            <img src="{{ $affiliate->imageSrc('thumb') }}" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.affiliates.hover_text') }}</p>
        </div>
    </a>
    <p class="heavy-heading affiliate-card-name">{{ $affiliate->name }}</p>
</div>