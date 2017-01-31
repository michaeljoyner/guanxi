<div class="contributor-card">
    <div class="contributor-card-profile-pic-box">
        <img src="{{ $contributor->avatar('thumb') }}" alt="{{ $contributor->name }}">
    </div>
    <div class="contributor-card-name-and-title">
        <p class="contributor-name heavy-heading">{{ $contributor->name }}</p>
        <p class="contributor-title light-heading purple-text">{{ $contributor->getTranslation('title', Localization::getCurrentLocale()) }}</p>
    </div>
    <div class="contributor-card-intro">
        <p class="contributor-intro">{{ $contributor->getTranslation('intro', Localization::getCurrentLocale()) }}</p>
    </div>
</div>