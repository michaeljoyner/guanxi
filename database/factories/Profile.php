<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\People\Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'name'      => $faker->name,
        'title'     => ['en' => 'Contributor', 'zh' => 'zh'],
        'intro'     => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'bio'       => ['en' => $faker->paragraphs(3, true), 'zh' => 'zh'],
        'published' => false
    ];
});
