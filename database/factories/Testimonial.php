<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Testimonials\Testimonial::class, function (Faker $faker) {
    return [
        'name'         => $faker->name,
        'language'     => $faker->randomElement(['en', 'zh']),
        'content'      => $faker->paragraph,
        'is_published' => $faker->boolean,
    ];
});

$factory->state(\App\Testimonials\Testimonial::class, 'private', [
    'is_published' => false,
]);

$factory->state(\App\Testimonials\Testimonial::class, 'public', [
    'is_published' => true,
]);
