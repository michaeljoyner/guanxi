<div class="media-image-card">
    <dd-lightbox :open="false"
                 title="A day Down in Mexico"
                 main-src="{{ collect(["/images/photo_default.jpg", "/images/gallery.jpg"])->random() }}"
                 :gallery-images='{{
                 collect([
                 '[{src: "/images/photo_default.jpg"}, {src: "/images/banners/about.jpeg"}, {src: "/images/pizza.jpg"}]',
                 '[{src: "/images/poolside.jpg"}, {src: "/images/banners/lifestyle.jpeg"}, {src: "/images/banners/gallery.jpg"}]',
                 '[{src: "/images/banners/articles.jpg"}, {src: "/images/banners/affiliates.jpg"}, {src: "/images/gallery.jpg"}]'])->random()
                 }}'
    ></dd-lightbox>
    <p class="media-image-card-title heavy-heading">{{ collect(['things in repose', 'a more than two line headline too carzy', 'hot shots of pots', 'boobs'])->random() }}</p>
    <p class="media-image-card-contributor purple-text light-heading">{{ collect([
        'Ernest Hemingway', 'Lucy Lui', 'Alan Donald', 'Sarah Jenkins'
    ])->random() }}</p>
</div>