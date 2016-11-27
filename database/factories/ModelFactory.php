<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\People\Profile::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'title' => ['en' => 'Contributor', 'zh' => 'Xie ren'],
        'intro' => ['en' => $faker->paragraph, 'zh' => $faker->paragraph],
        'bio'   => ['en' => $faker->paragraphs(3, true), 'zh' => $faker->paragraphs(3, true)],
        'published' => false
    ];
});

$factory->define(App\Content\Article::class, function (Faker\Generator $faker) {
    return [
        'profile_id'      => function () {
            return factory(\App\People\Profile::class)->create()->id;
        },
        'title'        => ['en' => $faker->sentence, 'zh' => $faker->sentence],
        'description'  => ['en' => $faker->paragraph, 'zh' => $faker->paragraph],
        'body'         => ['en' => $faker->paragraph(20), 'zh' => $faker->paragraph(20)],
        'published_on' => null,
        'published'    => false,
    ];
});

$factory->define(App\Content\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => ['en' => $faker->sentence, 'zh' => $faker->sentence],
        'description' => ['en' => $faker->paragraph, 'zh' => $faker->paragraph],
        'writeup'     => ['en' => $faker->paragraph(5), 'zh' => $faker->paragraph(5)],
    ];
});

$factory->define(App\Content\Tag::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->word
    ];
});

$factory->define(App\Affiliates\Affiliate::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->word,
        'location' => ['en' => $faker->address, 'zh' => $faker->address],
        'writeup' => ['en' => $faker->paragraphs(3, true), 'zh' => $faker->paragraphs(3, true)],
        'phone' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'published' => false
    ];
});
