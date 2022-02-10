<footer class="bg-black text-white type-b1 pt-20 px-4 pb-4">
    <div class="flex flex-col md:flex-row justify-between mt-20 md:mt-0">
        <div class="w-full md:w-1/3 order-2 md:order-1">
            @include('svg.logo_noborder', ['classes' => 'h-24 mb-12 block mx-auto'])
            <p class="mx-6 border border-white p-4 text-white type-b5">{{ trans('footer.mission') }}</p>
        </div>
        <div class="w-full md:w-2/3 flex-1 order-1 md:order-2">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between px-4">
                <div class="w-full md:w-1/2 flex flex-col items-center">
                    <p class="type-h4 text-mid-grey">Contact</p>
                    <p class="type-b5 contact-detail">+886 (0) 958 715 550</p>
                    <p class="type-b5 contact-detail">email@guanxi.com</p>
                    <div class="text-center">
                        <a href="https://www.facebook.com/GuanXiMedia/">
                            @include('svgicons.social.facebook', ['classes' => 'h-8 my-6  text-mid-grey hover:text-white'])
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex flex-col items-center mb-12 md:mb-0">
                    <p class="type-h4 text-mid-grey">Quicklinks</p>
                    <ul class="text-center">
                        <li><a class="hover:text-mid-grey type-b5" href="{{ localUrl('/') }}">Home</a></li>
                        <li><a class="hover:text-mid-grey type-b5" href="{{ localUrl('/about') }}">About</a></li>
                        <li><a class="hover:text-mid-grey type-b5" href="{{ localUrl('/contact') }}">Contact</a></li>
                    </ul>

                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between px-4">
                <div class="w-full md:w-1/2 flex flex-col items-center mb-12 md:mb-0">
                    <p class="type-h4 text-mid-grey">Trending</p>
                    <ul class="footer-links-list">
                        @foreach($trendingArticles as $trending)
                            <li class="text-center"><a class="hover:text-mid-grey type-b5" href="{{ localUrl('/articles/' . $trending->slug) }}">{{ $trending->title }}</a></li>
                        @endforeach
                    </ul>
                    <x-buy-a-coffee mode="light" :useSupportMessage="false"></x-buy-a-coffee>
                </div>
                <div class="w-full md:w-1/2 flex flex-col items-center mb-12 md:mb-0">
                    <p class="type-h4 text-mid-grey">Categories</p>
                    <ul class="text-center">
                        @foreach($navCategories as $navCategory)
                            <li><a class="hover:text-mid-grey type-b5" href="{{ localUrl('/categories/' . $navCategory->slug) }}">{{ $navCategory->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <p class="mt-12 text-center text-sm">&copy; {{ \Illuminate\Support\Carbon::now()->year }}. Beautifully built by <a target="_blank" rel="noopener noreferrer" class="hover:text-primary-blue" href="https://dymanticdesign.com">Dymantic Design</a>.</p>
</footer>