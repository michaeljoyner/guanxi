<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Content\Slideshow::class, function (Faker $faker) {
    return [
        'article_id' => factory(\App\Content\Article::class),
        'title' => $faker->words(4, true)
    ];
});
