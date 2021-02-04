<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Content\Article;
use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Content\Article::class, function (Faker $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'profile_id'   => function () {
            return factory(\App\People\Profile::class)->create()->id;
        },
        'title'        => ['en' => $faker->sentence, 'zh' => ''],
        'description'  => ['en' => $faker->paragraph, 'zh' => ''],
        'body'         => ['en' => $faker->paragraph(20), 'zh' => ''],
        'published_on' => null,
        'published'    => false,
        'is_featured'  => false,
        'designation' => $faker->randomElement([Article::WORLD, Article::TAIWAN])
    ];
});

$factory->state(Article::class, 'published', [
    'profile_id' => 1,
    'published_on' => \Carbon\Carbon::yesterday(),
    'published'    => true,
]);
