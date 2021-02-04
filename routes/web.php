<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::group(['prefix' => Localization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'PagesController@home');

    Route::get('about', 'PagesController@about');

    Route::get('testimonials', 'TestimonialsController@index');

    Route::get('articles', 'ArticlesController@index');
    Route::get('articles/tags/{slug}', 'TagArticlesController@index');
    Route::get('articles/{slug}', 'ArticlesController@show');

    Route::get('admin/preview/articles/{article}', 'Admin\ArticlesPreviewController@show')->middleware('auth');

    Route::get('categories/{slug}', 'CategoriesController@show');


    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/photos', 'GalleriesController@photos');
    Route::get('galleries/art', 'GalleriesController@art');

    Route::get('galleries/videos', 'VideosController@index');
    Route::get('videos/{slug}', 'VideosController@show');

    Route::post('contact', 'ContactController@sendMessage');

    Route::get('api/content/articles', 'Api\ArticlesController@index');
    Route::get('api/content/categories/{category:slug}', 'Api\CategoriesController@index');
    Route::get('api/content/articles/tags/{slug}', 'Api\TagArticlesController@index');
    Route::get('api/galleries', 'Api\GalleriesController@index');
    Route::get('api/galleries/photos', 'Api\GalleriesController@photos');
    Route::get('api/galleries/art', 'Api\GalleriesController@art');
    Route::get('api/galleries/videos', 'Api\VideosController@galleryVideos');

    Route::get('api/profiles/{slug}/contributions/articles', 'Api\BioContributionsController@articles');
    Route::get('api/profiles/{slug}/contributions/media', 'Api\BioContributionsController@media');
    Route::get('api/profiles/{slug}/contributions/videos', 'Api\BioContributionsController@videos');
});

Route::get('/admin/login', 'Auth\LoginController@showLoginForm');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::get('/admin/logout', 'Auth\LoginController@logout');

Route::post('/admin/users', 'Auth\RegisterController@register')->middleware('superadmin');

Route::get('admin/password/show/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@home')->name('dashboard');

    Route::get('users/{user}/password/edit', 'AdminPasswordController@edit');
    Route::post('users/{user}/password', 'AdminPasswordController@update');

    Route::get('users', 'UsersController@index')->middleware('superadmin');
    Route::get('users/{user}', 'UsersController@show')->middleware('superadmin');
    Route::get('users/{user}/edit', 'UsersController@edit')->middleware('superadmin');
    Route::post('users/{user}', 'UsersController@update')->middleware('superadmin');
    Route::delete('users/{user}', 'UsersController@delete')->middleware('superadmin');

    Route::get('profiles', 'ProfilesController@index');
    Route::post('profiles', 'ProfilesController@store')->middleware(['superadmin']);
    Route::get('profiles/{profile}', 'ProfilesController@show')->middleware('can:act,profile');
    Route::get('profiles/{profile}/edit', 'ProfilesController@edit')->middleware('can:act,profile');
    Route::post('profiles/{profile}', 'ProfilesController@update')->middleware(['can:act,profile']);
    Route::delete('profiles/{profile}', 'ProfilesController@delete')->middleware('superadmin');

    Route::post('profiles/{profile}/avatar', 'ProfileAvatarsController@store')->middleware('can:act,profile');

    Route::post('profiles/{profile}/publish', 'ProfilePublishingController@update')->middleware('can:act,profile');

    Route::post('profiles/{profile}/user', 'ProfileUserController@store')->middleware('superadmin');

    //must be at top of articles
    Route::get('content/articles/featured', 'FeaturedArticleController@show');
    Route::post('content/articles/{article}/feature', 'FeaturedArticleController@update')->middleware('superadmin');

    Route::get('content/articles', 'ArticlesController@index');
    Route::get('content/articles/{article}', 'ArticlesController@show')->middleware('can:update,article');
    Route::get('content/articles/{article}/edit', 'ArticlesController@edit')->middleware('can:update,article');
    Route::post('content/articles', 'ArticlesController@store');
    Route::post('content/articles/{article}', 'ArticlesController@update')->middleware('can:update,article');
    Route::delete('content/articles/{article}', 'ArticlesController@delete')->middleware('can:update,article');

    Route::get('content/articles/{article}/body/{lang}/edit', 'ArticlesBodyController@edit')
        ->middleware('can:update,article');
    Route::post('content/articles/{article}/body/{lang}', 'ArticlesBodyController@store')
        ->middleware('can:update,article');

    Route::post('content/articles/{article}/images', 'ArticleImagesController@store')
        ->middleware('can:update,article');

    Route::post('content/articles/{article}/author/{profile}', 'ArticleAuthorController@update')
        ->middleware('can:update,article');

    Route::get('content/articles/{article}/tags', 'ArticleTagsController@index')->middleware('can:update,article');
    Route::post('content/articles/{article}/tags', 'ArticleTagsController@store')->middleware('can:update,article');
    Route::put('content/articles/{article}/tags', 'ArticleTagsController@update')->middleware('can:update,article');

    Route::get('content/articles/{article}/images/featured/edit', 'ArticleFeaturedImagesController@edit')->middleware('can:update,article');



    Route::get('content/categories', 'CategoriesController@index')->middleware('superadmin');
    Route::get('content/categories/{category}', 'CategoriesController@show')->middleware('superadmin');
    Route::get('content/categories/{category}/edit', 'CategoriesController@edit')->middleware('superadmin');
    Route::post('content/categories', 'CategoriesController@store')->middleware('superadmin');
    Route::post('content/categories/{category}', 'CategoriesController@update')->middleware('superadmin');
    Route::delete('content/categories/{category}', 'CategoriesController@delete')->middleware('superadmin');

    Route::post('content/categories/{category}/image', 'CategoryImagesController@store')->middleware('superadmin');

    Route::get('content/tags', 'TagsController@index')->middleware('superadmin');

    Route::get('media/videos', 'VideosController@index');
    Route::get('media/videos/{video}', 'VideosController@show')->middleware('can:act,video');
    Route::post('media/videos/{video}', 'VideosController@update')->middleware('can:act,video');
    Route::delete('media/videos/{video}', 'VideosController@delete')->middleware('can:act,video');
    Route::get('media/videos/{video}/edit', 'VideosController@edit')->middleware('can:act,video');
    Route::post('media/videos', 'VideosController@store');

    Route::post('media/videos/{video}/publish', 'VideoPublishingController@update')->middleware('can:act,video');

    Route::post('media/videos/{video}/contributors/{profile}', 'VideoContributorsController@update')->middleware('can:act,video');

    Route::get('media/photos', 'PhotosController@index');
    Route::get('media/photos/{photo}', 'PhotosController@show')->middleware('can:act,photo');
    Route::get('media/photos/{photo}/edit', 'PhotosController@edit')->middleware('can:act,photo');
    Route::post('media/photos', 'PhotosController@store');
    Route::post('media/photos/{photo}', 'PhotosController@update')->middleware('can:act,photo');
    Route::delete('media/photos/{photo}', 'PhotosController@delete')->middleware('can:act,photo');

    Route::post('media/photos/{photo}/publish', 'PhotoPublishingController@update')->middleware('can:act,photo');

    Route::post('media/photos/{photo}/mainimage', 'PhotoMainImageController@store')->middleware('can:act,photo');
    Route::get('media/photos/{photo}/gallery', 'PhotoGalleriesController@show')->middleware('can:act,photo');

    Route::post('media/photos/{photo}/contributors/{profile}', 'PhotoContributorsController@update')->middleware('can:act,photo');

    Route::get('media/artworks', 'ArtworksController@index');
    Route::get('media/artworks/{artwork}', 'ArtworksController@show')->middleware('can:act,artwork');
    Route::get('media/artworks/{artwork}/edit', 'ArtworksController@edit')->middleware('can:act,artwork');
    Route::post('media/artworks', 'ArtworksController@store');
    Route::post('media/artworks/{artwork}', 'ArtworksController@update')->middleware('can:act,artwork');
    Route::delete('media/artworks/{artwork}', 'ArtworksController@delete')->middleware('can:act,artwork');

    Route::get('media/artworks/{artwork}/gallery', 'ArtworksGalleryController@show')->middleware('can:act,artwork');
    Route::post('media/artworks/{artwork}/mainimage', 'ArtworkImagesController@store')->middleware('can:act,artwork');

    Route::post('media/artworks/{artwork}/publish', 'ArtworkPublishingController@update')->middleware('can:act,artwork');

    Route::post('media/artworks/{artwork}/contributors/{profile}', 'ArtworkContributorsController@update')->middleware('can:act,artwork');

    Route::get('pages/about', 'AboutPagesController@show')->middleware('superadmin');

    Route::get('pages/about/story/edit', 'AboutPageStoryController@edit')->middleware('superadmin');
    Route::post('pages/about/story', 'AboutPageStoryController@update')->middleware('superadmin');

    Route::get('pages/about/marketing/edit', 'AboutPageMarketingController@edit')->middleware('superadmin');
    Route::post('pages/about/marketing', 'AboutPageMarketingController@update')->middleware('superadmin');

    Route::get('pages/about/events/edit', 'AboutPageEventsController@edit')->middleware('superadmin');
    Route::post('pages/about/events', 'AboutPageEventsController@update')->middleware('superadmin');

    Route::get('pages/about/contribute/edit', 'AboutPageContributeController@edit')->middleware('superadmin');
    Route::post('pages/about/contribute', 'AboutPageContributeController@update')->middleware('superadmin');

    Route::get('pages/about/contact/edit', 'AboutPageContactController@edit')->middleware('superadmin');
    Route::post('pages/about/contact', 'AboutPageContactController@update')->middleware('superadmin');

    Route::get('testimonials', 'TestimonialsController@index')->middleware('superadmin');
    Route::get('testimonials/{testimonial}', 'TestimonialsController@show')->middleware('superadmin');
    Route::get('testimonials/{testimonial}/edit', 'TestimonialsController@edit')->middleware('superadmin');
    Route::post('testimonials', 'TestimonialsController@store')->middleware('superadmin');
    Route::post('testimonials/{testimonial}', 'TestimonialsController@update')->middleware('superadmin');
    Route::delete('testimonials/{testimonial}', 'TestimonialsController@delete')->middleware('superadmin');

    Route::post('published-testimonials', 'PublishedTestimonialsController@store')->middleware('superadmin');
    Route::delete('published-testimonials/{testimonial}', 'PublishedTestimonialsController@destroy')
         ->middleware('superadmin');

    Route::post('testimonials/{testimonial}/avatar', 'TestimonialAvatarsController@store');

    Route::post('articles/{article}/slideshows', 'SlideshowsController@store');
    Route::delete('slideshows/{slideshow}', 'SlideshowsController@delete');

    Route::get('slideshows/{slideshow}/images', 'SlideshowImagesController@index');
    Route::post('slideshows/{slideshow}/images', 'SlideshowImagesController@store');

    Route::get('slideshows/{slideshow}/edit', 'SlideshowsController@edit');

    Route::delete('slideshow-images/{media}', 'SlideshowImagesController@destroy');

    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
        // admin api routes
        Route::get('content/categories', 'CategoriesController@index');
        Route::post('content/articles/{article}/categories', 'ArticleCategoriesController@update')
            ->middleware('can:update,article');
        Route::post('content/articles/{article}/publish', 'ArticlePublishController@update')
            ->middleware('can:update,article');

        Route::get('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@index')
            ->middleware('can:update,article');
        Route::patch('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@update')
            ->middleware('can:update,article');
        Route::post('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@store')
            ->middleware('can:update,article');

        Route::get('profiles', 'ProfilesController@index');

        Route::get('tags', 'TagsController@index');
        Route::post('tags/delete', 'TagsController@delete')
        ->middleware('superadmin');

        Route::get('media/photos/{photo}/gallery/images', 'PhotoGalleryImagesController@index')
            ->middleware('can:act,photo');
        Route::post('media/photos/{photo}/gallery/images', 'PhotoGalleryImagesController@store')
            ->middleware('can:act,photo');
        Route::delete('media/photos/{photo}/gallery/images/{media}', 'PhotoGalleryImagesController@delete')
            ->middleware('can:act,photo');

        Route::get('media/artworks/{artwork}/gallery/images', 'ArtworkGalleryImagesController@index')->middleware('can:act,artwork');
        Route::post('media/artworks/{artwork}/gallery/images', 'ArtworkGalleryImagesController@store')->middleware('can:act,artwork');
        Route::delete('media/artworks/{artwork}/gallery/images/{media}', 'ArtworkGalleryImagesController@delete')->middleware('can:act,artwork');

        Route::post('video/embed', 'VideoEmbedCodeController@store');


    });

});