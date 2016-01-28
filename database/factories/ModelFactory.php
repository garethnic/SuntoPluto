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

$factory->define(Flisk\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => rand(0, 1) ? 'm' : 'f',
        'confirmed' => $faker->boolean(),
        'username' => $faker->name,
        'email' => $faker->email,
        'timezone' => $faker->timezone,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Flisk\Admin::class, function (Faker\Generator $faker) {
   return [
       'first_name' => $faker->firstName,
       'last_name' => $faker->lastName,
       'username' => $faker->name,
       'email' => $faker->email,
       'timezone' => $faker->timezone,
       'password' => bcrypt('password'),
       'remember_token' => str_random(10),
   ];
});

$factory->define(\Flisk\Task::class, function (Faker\Generator $faker) {
   return [
        'content' => $faker->sentence(rand(3, 8)),
        'done' => 0,
   ];
});

$factory->define(\Flisk\Board::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'identifier' => $faker->uuid
    ];
});
