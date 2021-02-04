<div class="main-nav fixed top-0 w-full  h-16 flex justify-between items-center bg-brand-purple lg:bg-white lg:shadow text-white lg:text-black z-50">
    <a class="relative h-16 pl-6 lg:pl-12" href="{{ localUrl('/') }}">
        @include('svg.logo_purple', ['classes' => 'h-12 lg:h-16 absolute top-0 mt-2 z-50 nav-logo'])
    </a>
    <div class="nav-links absolute top-16 w-full lg:static min-h-screen lg:min-h-0 bg-brand-soft-purple lg:bg-transparent flex flex-col lg:flex-row lg:justify-end lg:items-center lg:pr-12 pt-6 lg:pt-0">
        <div class="flex flex-col lg:flex-row lg:items-center px-6 nav-dropdown lg:h-16 relative group my-3 lg:my-0">
            <a class="uppercase" href="{{ localUrl('/articles') }}">{{ trans('navbar.articles') }}</a>
            @include('svgicons.downcaret', ['classes' => 'hidden lg:block'])
            <div class="w-max-content lg:hidden my-2 lg:my-0 flex flex-col group-hover:flex lg:justify-center items-start lg:items-center lg:bg-white static lg:absolute top-16 left-0 lg:shadow">
                @foreach($navCategories as $navCat)
                    <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/categories/' . $navCat->slug) }}">{{ $navCat->getTranslation('name', Localization::getCurrentLocale()) }}</a>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col lg:flex-row lg:items-center px-6 nav-dropdown lg:h-16 relative group my-3 lg:my-0">
            <a class="uppercase" href="{{ localUrl('/galleries') }}">{{ trans('navbar.gallery') }}</a>
            <span class="nav-caret"> @include('svgicons.downcaret', ['classes' => 'hidden lg:block'])</span>
            <div class="w-max-content lg:hidden my-2 lg:my-0 flex flex-col group-hover:flex lg:justify-center items-start lg:items-center lg:bg-white static lg:absolute top-16 left-0 lg:shadow">
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/galleries/photos') }}">{{ trans('navbar.photos') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/galleries/art') }}">{{ trans('navbar.art') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/galleries/videos') }}">{{ trans('navbar.video') }}</a>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row lg:items-center px-6 nav-dropdown lg:h-16 relative group my-3 lg:my-0">
            <a class="uppercase" href="{{ localUrl('/about') }}">{{ trans('navbar.about') }}</a>
            <span class="nav-caret"> @include('svgicons.downcaret', ['classes' => 'hidden lg:block'])</span>
            <div class="w-max-content lg:hidden my-2 lg:my-0 flex flex-col group-hover:flex lg:justify-center items-start lg:items-center lg:bg-white static lg:absolute top-16 left-0 lg:shadow">
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/about#marketing') }}">{{ trans('navbar.marketing') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/about#events') }}">{{ trans('navbar.events') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/about#story') }}">{{ trans('navbar.ourstory') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/about#contribute') }}">{{ trans('navbar.contribute') }}</a>
                <a class="lg:mx-6 uppercase lg:py-1 px-2 lg:px-6 lg:my-1" href="{{ localUrl('/about#contact') }}">{{ trans('navbar.contact') }}</a>
            </div>
        </div>
        <a class="my-3 lg:my-0 mx-6 uppercase" href="{{ transUrl(Request::path()) }}">{{ trans('navbar.lang') }}</a>
    </div>
    <div class="lg:hidden pr-6">
        <button id="nav-trigger" class="focus:outline-none">
            <svg class="h-12 text-white fill-current menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.4 9H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1zm0 4H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1zM3.6 7h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1z"/></svg>
            <svg class="h-8 text-white fill-current close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
        </button>
    </div>
</div>