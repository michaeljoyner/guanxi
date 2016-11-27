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

Route::get('/', function () {
    return view('welcome');
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

    Route::get('content/categories', 'CategoriesController@index');
    Route::get('content/categories/{category}', 'CategoriesController@show');
    Route::get('content/categories/{category}/edit', 'CategoriesController@edit');
    Route::post('content/categories', 'CategoriesController@store');
    Route::post('content/categories/{category}', 'CategoriesController@update');
    Route::delete('content/categories/{category}', 'CategoriesController@delete');

    Route::post('content/categories/{category}/image', 'CategoryImagesController@store');

    Route::get('affiliates', 'AffiliatesController@index');
    Route::get('affiliates/{affiliate}', 'AffiliatesController@show');
    Route::get('affiliates/{affiliate}/edit', 'AffiliatesController@edit');
    Route::post('affiliates', 'AffiliatesController@store');
    Route::post('affiliates/{affiliate}', 'AffiliatesController@update');
    Route::delete('affiliates/{affiliate}', 'AffiliatesController@delete');

    Route::post('affiliates/{affiliate}/publish', 'AffiliatePublishingController@update');
    Route::post('affiliates/{affiliate}/image', 'AffiliateImageController@store');

    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
        // admin api routes
        Route::get('content/categories', 'CategoriesController@index');
        Route::post('content/articles/{article}/categories', 'ArticleCategoriesController@update');
        Route::post('content/articles/{article}/publish', 'ArticlePublishController@update');

        Route::get('profiles', 'ProfilesController@index');
    });

});