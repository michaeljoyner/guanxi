<footer class="main-footer">
    <div class="footer-column branding-column">
        @include('svg.logo_noborder')
        <p class="footer-definition">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, corporis nostrum. Amet architecto aut cupiditate delectus doloremque eaque, facere impedit laborum obcaecati quas quos reiciendis sequi vel veniam vero vitae!</p>
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
                <li><a href="#">Why is Taiwan the shit?</a></li>
                <li><a href="#">Top 10 Haunted Houses</a></li>
                <li><a href="#">How to eat a tea egg</a></li>
                <li><a href="#">LGBT Bars</a></li>
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