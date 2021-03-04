<section id="contact" class="pt-10 pb-20 px-6">
{{--    <h1 class="type-h1 text-center mb-20">{{ trans('about.contact.heading') }}</h1>--}}
    <div class="max-w-2xl mx-auto">{!! $page->contact !!}</div>

    <div class="contact-form-section max-w-2xl mx-auto">
        <p class="my-12">Or just send a message here:</p>
        <contact-form :labels='@json($labels)' :dialogs='@json($dialogs)'></contact-form>
    </div>
</section>