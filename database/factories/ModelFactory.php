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
        'role_id' => 1
    ];
});

$factory->define(App\People\Profile::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'name'      => $faker->name,
        'title'     => ['en' => 'Contributor', 'zh' => 'zh'],
        'intro'     => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'bio'       => ['en' => $faker->paragraphs(3, true), 'zh' => 'zh'],
        'published' => false
    ];
});

$factory->define(App\Content\Article::class, function (Faker\Generator $faker) {
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
        'is_featured'  => false
    ];
});

$factory->define(App\Content\Category::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'name'        => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'writeup'     => ['en' => $faker->paragraph(5), 'zh' => 'zh'],
    ];
});

$factory->define(App\Content\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Affiliates\Affiliate::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'name'      => $faker->word,
        'location'  => ['en' => $faker->address, 'zh' => 'zh'],
        'writeup'   => ['en' => $faker->paragraphs(3, true), 'zh' => 'zh'],
        'phone'     => $faker->phoneNumber,
        'website'   => $faker->domainName,
        'published' => false
    ];
});

$factory->define(App\Media\Video::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'title'       => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'profile_id'  => function () {
            return factory(\App\People\Profile::class)->create()->id;
        },
        'video_url'   => $faker->randomElement([
            'https://www.youtube.com/watch?v=Aw28-krO7ZM',
            'https://vimeo.com/194481035'
        ]),
        'embed_url'   => $faker->randomElement([
            'https://www.youtube.com/watch?v=Aw28-krO7ZM',
            'https://vimeo.com/194481035'
        ]),
        'published'   => false,
        'thumbnail' => $faker->imageUrl(400, 300, 'abstract')
    ];
});

$factory->define(App\Media\Photo::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'title'       => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'profile_id'  => function () {
            return factory(\App\People\Profile::class)->create()->id;
        },
        'published'   => false
    ];
});

$factory->define(App\Media\Artwork::class, function (Faker\Generator $faker) {
//    $zh_faker = Faker\Factory::create('zh_TW');
    return [
        'title'       => ['en' => $faker->sentence, 'zh' => 'zh'],
        'description' => ['en' => $faker->paragraph, 'zh' => 'zh'],
        'profile_id'  => function () {
            return factory(\App\People\Profile::class)->create()->id;
        },
        'published'   => false
    ];
});
