<nav class="main-navbar">
    <div class="branding">
        <a href="/">@include('svg.logo_purple')</a>
    </div>
    <label for="nav-trigger" class="nav-trigger-icon">@include('svgicons.menu')</label>
    <input type="checkbox" id="nav-trigger">
    <div class="menu-container">
        <ul class="main-nav-list">
            <label for="nav-trigger" class="nav-trigger-close-icon">&times;</label>
            <li class="articles-nav nav-item @activenav('articles')">
                <a href="{{ localUrl('/articles') }}">{{ trans('navbar.articles') }}</a>
                <span class="nav-caret"> @include('svgicons.downcaret')</span>
                <ul class="secondary-nav-list">
                    @foreach($navCategories as $navCat)
                        <li class="secondary-nav-item">
                            <a href="{{ localUrl('/categories/' . $navCat->slug) }}">{{ $navCat->getTranslation('name', Localization::getCurrentLocale()) }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="gallery-nav nav-item @activenav('galleries')">
                <a href="{{ localUrl('/galleries') }}">{{ trans('navbar.gallery') }}</a>
                <span class="nav-caret"> @include('svgicons.downcaret')</span>
                <ul class="secondary-nav-list">
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/galleries/photos') }}">{{ trans('navbar.photos') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/galleries/art') }}">{{ trans('navbar.art') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/galleries/videos') }}">{{ trans('navbar.video') }}</a>
                    </li>
                </ul>
            </li>
            <li class="about-nav nav-item @activenav('about')">
                <a href="{{ localUrl('/about') }}">{{ trans('navbar.about') }}</a>
                <span class="nav-caret"> @include('svgicons.downcaret')</span>
                <ul class="secondary-nav-list">
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/about#marketing') }}">{{ trans('navbar.marketing') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/about#events') }}">{{ trans('navbar.events') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/about#story') }}">{{ trans('navbar.ourstory') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/about#contribute') }}">{{ trans('navbar.contribute') }}</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="{{ localUrl('/about#contact') }}">{{ trans('navbar.contact') }}</a>
                    </li>
                </ul>
            </li>
            <li class="bios-nav nav-item @activenav('bios')">
                <a href="{{ localUrl('/bios') }}">{{ trans('navbar.bios') }}</a>
            </li>
            <li class="affiliates-nav nav-item">
                <a href="{{ localUrl('/affiliates') }}">{{ trans('navbar.affiliates') }}</a>
            </li>
            @foreach(Localization::getSupportedLocales() as $localeCode => $properties)
                @if($localeCode !== Localization::getCurrentLocale())
                    <li class="nav-item">
                        <a rel="alternate" hreflang="{{$localeCode}}"
                           href="{{Localization::getLocalizedURL($localeCode) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>