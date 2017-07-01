<footer class="main-footer">
    <div class="footer-column branding-column">
        @include('svg.logo_noborder')
        <p class="footer-definition">Guan Xi Media provides compelling content and a platform for artists, writers, journalists, storytellers, photographers, explorers, entrepreneurs, activists, and philanthropists, from all around the globe.  We welcome all genres and voices, and encourage anyone who has tenacity and a desire to affect positive change in the world, to make moves and contribute.  Get some!</p>
    </div>
    <div class="footer-column contact-column">
        <div class="footer-column-block">
            <p class="footer-header">Contact</p>
            <p class="contact-detail">+886 (0) 989 654 345</p>
            <p class="contact-detail">email@guanxi.com</p>
            <div class="footer-social-icons">
                <a href="https://twitter.com/home?status=">
                    @include('svgicons.social.twitter')
                </a>
                <a href="https://www.facebook.com/">
                    @include('svgicons.social.facebook')
                </a>
                <a href="">
                    @include('svgicons.social.instagram')
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
                <li><a href="{{ localUrl('/affiliates') }}">Affiliates</a></li>
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