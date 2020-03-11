<?php

namespace App\Providers;

use App\Content\ArticlesRepository;
use App\Content\Category;
use App\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['front.partials.navbar', 'front.partials.footer'], function ($view) {
            $navCategories = Category::withCount('articles')->get()->reject(function ($category) {
                return $category->articles_count < 1;
            });

            return $view->with(compact('navCategories'));
        });

        View::composer('front.partials.footer', function($view) {
            $trendingArticles = (new ArticlesRepository())->latestPublished();

            return $view->with(compact('trendingArticles'));
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
