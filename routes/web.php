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

    Route::get('articles', 'ArticlesController@index');
    Route::get('articles/tags/{slug}', 'TagArticlesController@index');
    Route::get('articles/{slug}', 'ArticlesController@show');
    
    Route::get('categories/{slug}', 'CategoriesController@show');

    Route::get('bios', 'BiosController@index');
    Route::get('bios/{slug}', 'BiosController@show');

    Route::get('affiliates', 'AffiliatesController@index');
    Route::get('affiliates/{affiliate}', 'AffiliatesController@show');

    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/photos', 'GalleriesController@photos');
    Route::get('galleries/art', 'GalleriesController@art');

    Route::get('galleries/videos', 'VideosController@index');
    Route::get('videos/{slug}', 'VideosController@show');

    Route::post('contact', 'ContactController@sendMessage');

    Route::get('api/content/articles', 'Api\ArticlesController@index');
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

Route::post('/admin/users', 'Auth\RegisterController@register');

Route::get('admin/password/show/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@home');

    Route::get('users/{user}/password/edit', 'AdminPasswordController@edit');
    Route::post('users/{user}/password', 'AdminPasswordController@update');

    Route::get('users', 'UsersController@index');
    Route::get('users/{user}', 'UsersController@show');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::post('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@delete');

    Route::get('profiles', 'ProfilesController@index');
    Route::post('profiles', 'ProfilesController@store');
    Route::get('profiles/{profile}', 'ProfilesController@show');
    Route::get('profiles/{profile}/edit', 'ProfilesController@edit');
    Route::post('profiles/{profile}', 'ProfilesController@update');

    Route::post('profiles/{profile}/avatar', 'ProfileAvatarsController@store');

    Route::post('profiles/{profile}/publish', 'ProfilePublishingController@update');

    //must be at top of articles
    Route::get('content/articles/featured', 'FeaturedArticleController@show');
    Route::post('content/articles/{article}/feature', 'FeaturedArticleController@update');

    Route::get('content/articles', 'ArticlesController@index');
    Route::get('content/articles/{article}', 'ArticlesController@show');
    Route::get('content/articles/{article}/edit', 'ArticlesController@edit');
    Route::post('content/articles', 'ArticlesController@store');
    Route::post('content/articles/{article}', 'ArticlesController@update');
    Route::delete('content/articles/{article}', 'ArticlesController@delete');

    Route::get('content/articles/{article}/body/{lang}/edit', 'ArticlesBodyController@edit');
    Route::post('content/articles/{article}/body/{lang}', 'ArticlesBodyController@store');

    Route::post('content/articles/{article}/images', 'ArticleImagesController@store');

    Route::post('content/articles/{article}/author/{profile}', 'ArticleAuthorController@update');

    Route::get('content/articles/{article}/tags', 'ArticleTagsController@index');
    Route::post('content/articles/{article}/tags', 'ArticleTagsController@store');
    Route::put('content/articles/{article}/tags', 'ArticleTagsController@update');

    Route::get('content/articles/{article}/images/featured/edit', 'ArticleFeaturedImagesController@edit');



    Route::get('content/categories', 'CategoriesController@index');
    Route::get('content/categories/{category}', 'CategoriesController@show');
    Route::get('content/categories/{category}/edit', 'CategoriesController@edit');
    Route::post('content/categories', 'CategoriesController@store');
    Route::post('content/categories/{category}', 'CategoriesController@update');
    Route::delete('content/categories/{category}', 'CategoriesController@delete');

    Route::post('content/categories/{category}/image', 'CategoryImagesController@store');

    Route::get('content/tags', 'TagsController@index');

    Route::get('affiliates', 'AffiliatesController@index');
    Route::get('affiliates/{affiliate}', 'AffiliatesController@show');
    Route::get('affiliates/{affiliate}/edit', 'AffiliatesController@edit');
    Route::post('affiliates', 'AffiliatesController@store');
    Route::post('affiliates/{affiliate}', 'AffiliatesController@update');
    Route::delete('affiliates/{affiliate}', 'AffiliatesController@delete');

    Route::post('affiliates/{affiliate}/publish', 'AffiliatePublishingController@update');
    Route::post('affiliates/{affiliate}/image', 'AffiliateImageController@store');

    Route::get('media/videos', 'VideosController@index');
    Route::get('media/videos/{video}', 'VideosController@show');
    Route::post('media/videos/{video}', 'VideosController@update');
    Route::delete('media/videos/{video}', 'VideosController@delete');
    Route::get('media/videos/{video}/edit', 'VideosController@edit');
    Route::post('media/videos', 'VideosController@store');

    Route::post('media/videos/{video}/publish', 'VideoPublishingController@update');

    Route::post('media/videos/{video}/contributors/{profile}', 'VideoContributorsController@update');

    Route::get('media/photos', 'PhotosController@index');
    Route::get('media/photos/{photo}', 'PhotosController@show');
    Route::get('media/photos/{photo}/edit', 'PhotosController@edit');
    Route::post('media/photos', 'PhotosController@store');
    Route::post('media/photos/{photo}', 'PhotosController@update');
    Route::delete('media/photos/{photo}', 'PhotosController@delete');

    Route::post('media/photos/{photo}/publish', 'PhotoPublishingController@update');

    Route::post('media/photos/{photo}/mainimage', 'PhotoMainImageController@store');
    Route::get('media/photos/{photo}/gallery', 'PhotoGalleriesController@show');

    Route::post('media/photos/{photo}/contributors/{profile}', 'PhotoContributorsController@update');

    Route::get('media/artworks', 'ArtworksController@index');
    Route::get('media/artworks/{artwork}', 'ArtworksController@show');
    Route::get('media/artworks/{artwork}/edit', 'ArtworksController@edit');
    Route::post('media/artworks', 'ArtworksController@store');
    Route::post('media/artworks/{artwork}', 'ArtworksController@update');
    Route::delete('media/artworks/{artwork}', 'ArtworksController@delete');

    Route::get('media/artworks/{artwork}/gallery', 'ArtworksGalleryController@show');
    Route::post('media/artworks/{artwork}/mainimage', 'ArtworkImagesController@store');

    Route::post('media/artworks/{artwork}/publish', 'ArtworkPublishingController@update');

    Route::post('media/artworks/{artwork}/contributors/{profile}', 'ArtworkContributorsController@update');

    Route::get('pages/about', 'AboutPagesController@show');

    Route::get('pages/about/story/edit', 'AboutPageStoryController@edit');
    Route::post('pages/about/story', 'AboutPageStoryController@update');

    Route::get('pages/about/marketing/edit', 'AboutPageMarketingController@edit');
    Route::post('pages/about/marketing', 'AboutPageMarketingController@update');

    Route::get('pages/about/events/edit', 'AboutPageEventsController@edit');
    Route::post('pages/about/events', 'AboutPageEventsController@update');

    Route::get('pages/about/contribute/edit', 'AboutPageContributeController@edit');
    Route::post('pages/about/contribute', 'AboutPageContributeController@update');

    Route::get('pages/about/contact/edit', 'AboutPageContactController@edit');
    Route::post('pages/about/contact', 'AboutPageContactController@update');

    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
        // admin api routes
        Route::get('content/categories', 'CategoriesController@index');
        Route::post('content/articles/{article}/categories', 'ArticleCategoriesController@update');
        Route::post('content/articles/{article}/publish', 'ArticlePublishController@update');

        Route::get('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@index');
        Route::patch('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@update');
        Route::post('content/articles/{article}/images/featured', 'ArticleFeaturedImageController@store');

        Route::get('profiles', 'ProfilesController@index');

        Route::get('tags', 'TagsController@index');
        Route::delete('tags', 'TagsController@delete');

        Route::get('media/photos/{photo}/gallery/images', 'PhotoGalleryImagesController@index');
        Route::post('media/photos/{photo}/gallery/images', 'PhotoGalleryImagesController@store');
        Route::delete('media/photos/{photo}/gallery/images/{media}', 'PhotoGalleryImagesController@delete');

        Route::get('media/artworks/{artwork}/gallery/images', 'ArtworkGalleryImagesController@index');
        Route::post('media/artworks/{artwork}/gallery/images', 'ArtworkGalleryImagesController@store');
        Route::delete('media/artworks/{artwork}/gallery/images/{media}', 'ArtworkGalleryImagesController@delete');
    });

});