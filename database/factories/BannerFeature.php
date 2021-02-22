<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content\Article;
use App\Content\BannerFeature;
use Faker\Generator as Faker;

$factory->define(BannerFeature::class, function (Faker $faker) {
    $article = factory(Article::class)->create();
    return [
        'feature_id' => $article->id,
        'feature_type' => Article::class,
    ];
});
