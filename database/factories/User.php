<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => \Illuminate\Support\Str::random(10),
        'role_id' => \App\Role::superadmin()->id,
    ];
});

$factory->state(\App\User::class, 'superadmin', [
    'role_id' => \App\Role::superadmin()->id,
]);

$factory->state(\App\User::class, 'contributor', [
    'role_id' => \App\Role::editor()->id,
]);
