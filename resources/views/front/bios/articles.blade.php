@if($articles->count())
    <p class="text-brand-purple mt-20 type-h3 text-center px-6 mb-20">{{ $bio->name }}'s {{ trans('bios.contributions.title') }}</p>
    <section class="pb-12 px-6">
        <p class="type-h3 text-center mb-12">{{ trans('bios.contributions.articles') }}</p>
        <div class="responsive-grid grid-item-64 max-w-4xl mx-auto" id="articles">
            @foreach($articles as $article)
                @include('front.home.articlecard')
            @endforeach
            @if($articles->count() === 1)
                <div></div>
            @endif
        </div>
        <content-loader container-id="articles"
                        url="{{ localUrl('/api/profiles/' . $bio->slug . '/contributions/articles') }}"
                        :has-more="{{ $articles->hasMorePages() ? 'true' : 'false' }}"
                        button-text="{{ trans('buttons.more.articles') }}"
        ></content-loader>
    </section>
@endif