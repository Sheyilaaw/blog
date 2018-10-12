<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomDigit,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Role::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'name' => $faker->name,
        'description' => $faker->text(15),
    ];
});

$factory->define(App\Model\Post::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'user_id' => $faker->unique()->randomDigit,
        'title' => $faker->name,
        'body' => $faker->text(255),
    ];
});

