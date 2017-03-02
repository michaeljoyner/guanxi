<div class="affiliate-card four-piece">
    <a href="{{ localUrl('/affiliates/' . $affiliate->slug) }}">
        <div class="card-image-holder">
            <img src="{{ $affiliate->imageSrc('thumb') }}" width="150" height="150" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.affiliates.hover_text') }}</p>
        </div>
    </a>
    <p class="heavy-heading affiliate-card-name">{{ $affiliate->name }}</p>
</div>