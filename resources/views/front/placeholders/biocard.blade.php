<div class="bio-card">
    <a href="#">
        <div class="card-image-holder">
            <img src="{{ collect(['/images/avatar1.png', '/images/avatar2.png', '/images/avatar3.png'])->random() }}" width="200" height="200" alt="">
            <p class="hover-action-indicator">{{ trans('homepage.contributors.hover_text') }}</p>
        </div>
    </a>
    <p class="bio-card-name heavy-heading">{{ collect([
        'Ernest Hemingway', 'Lucy Lui', 'Alan Donald', 'Sarah Jenkins'
    ])->random() }}</p>
    <p class="bio-card-contributor-title purple-text light-heading">{{ collect(['Writer', 'photographer', 'artist', 'tosser'])->random() }}</p>
    <p class="bio-card-bio">{{ trunc('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias dolores eaque est et excepturi, illo minus odit provident quia quo temporibus voluptatum! Culpa inventore ipsum magni necessitatibus officia rem saepe.', 180) }}</p>
    <div class="profile-social-links">
        <a href="#" class="social-link">
            @include('svgicons.social.twitter')
        </a>
        <a href="#" class="social-link">
            @include('svgicons.social.facebook')
        </a>
        <a href="#" class="social-link">
            @include('svgicons.social.twitter')
        </a>
        <a href="#" class="social-link">
            @include('svgicons.social.email')
        </a>
    </div>
</div>