<?php

namespace App\Providers;

use App\Content\Category;
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
