<div class="bio-card">
    <a href="/bios/{{ $profile->slug }}" class="bio-image-and-link">
        <div class="card-image-holder rounded">
            <img src="{{ $profile->avatar('thumb') }}" width="200" height="200" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.contributors.hover_text') }}</p>
        </div>
    </a>
    <p class="bio-card-name heavy-heading">{{ $profile->name }}</p>
    <p class="bio-card-contributor-title purple-text light-heading">{{ $profile->title }}</p>
    <p class="bio-card-bio">{{ trunc($profile->intro, 180) }}</p>
    <div class="profile-social-links">
        @foreach($profile->socialLinks as $link)
            <a href="{{ $link->link }}" class="social-link">
                @include('svgicons.social.' . $link->platform)
            </a>
        @endforeach
    </div>
</div>