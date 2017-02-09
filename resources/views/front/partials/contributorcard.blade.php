<div class="contributor-card">
    <div class="contributor-card-profile-pic-box">
        <a href="{{ localUrl('/bios/' . $contributor->slug) }}">
            <img src="{{ $contributor->avatar('thumb') }}" alt="{{ $contributor->name }}">
        </a>
    </div>
    <div class="contributor-card-name-and-title">
        <p class="contributor-name heavy-heading"><a href="{{ localUrl('/bios/' . $contributor->slug) }}">{{ $contributor->name }}</a></p>
        <p class="contributor-title light-heading purple-text">{{ $contributor->getTranslation('title', Localization::getCurrentLocale()) }}</p>
    </div>
    <div class="contributor-card-intro">
        <p class="contributor-intro">{{ $contributor->getTranslation('intro', Localization::getCurrentLocale()) }}</p>
    </div>
</div>