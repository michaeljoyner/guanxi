<footer class="main-footer">
    <div class="footer-column branding-column">
        @include('svg.logo_noborder')
        <p class="footer-definition">{{ trans('footer.mission') }}</p>
    </div>
    <div class="footer-column contact-column">
        <div class="footer-column-block">
            <p class="footer-header">Contact</p>
            <p class="contact-detail">+886 (0) 958 715 550</p>
            <p class="contact-detail">email@guanxi.com</p>
            <div class="footer-social-icons">
                <a href="https://www.facebook.com/GuanXiMedia/">
                    @include('svgicons.social.facebook')
                </a>
            </div>
        </div>
        <div class="footer-column-block">
            <p class="footer-header">Trending</p>
            <ul class="footer-links-list">
                @foreach($trendingArticles as $trending)
                    <li><a href="{{ localUrl('/articles/' . $trending->slug) }}">{{ $trending->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer-column quicklinks-column">
        <div class="footer-column-block">
            <p class="footer-header">Quicklinks</p>
            <ul class="footer-links-list">
                <li><a href="{{ localUrl('/') }}">Home</a></li>
                <li><a href="{{ localUrl('/about') }}">About</a></li>
                <li><a href="{{ localUrl('/galleries') }}">Gallery</a></li>
                <li><a href="{{ localUrl('/bios') }}">Contributors</a></li>
            </ul>
        </div>
        <div class="footer-column-block">
            <p class="footer-header">Categories</p>
            <ul class="footer-links-list">
                @foreach($navCategories as $navCategory)
                    <li><a href="{{ localUrl('/categories/' . $navCategory->slug) }}">{{ $navCategory->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>