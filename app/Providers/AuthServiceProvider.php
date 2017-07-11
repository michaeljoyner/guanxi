<?php

namespace App\Providers;

use App\Content\Article;
use App\Media\Artwork;
use App\Media\Photo;
use App\Media\Video;
use App\People\Profile;
use App\Policies\ArticlePolicy;
use App\Policies\ArtworkPolicy;
use App\Policies\PhotoPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\VideoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Profile::class => ProfilePolicy::class,
        Photo::class => PhotoPolicy::class,
        Artwork::class => ArtworkPolicy::class,
        Video::class => VideoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
