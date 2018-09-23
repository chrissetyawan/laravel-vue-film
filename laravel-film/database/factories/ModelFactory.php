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

$factory->define(App\User::class, function (\Faker\Generator $faker) {

    return [
        'username' => str_replace('.', '', $faker->unique()->userName),
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret'
    ];
});

$factory->define(App\Film::class, function (\Faker\Generator $faker) {

    static $reduce = 999;

    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraphs($faker->numberBetween(1, 3), true),
        'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'rating' => $faker->numberBetween(1, 5),
        'ticket_price' => $faker->numberBetween(100, 500),
        'country' => $faker->country(),
        'photo' => 'https://cdn.worldvectorlogo.com/logos/laravel.svg',
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});

$factory->define(App\Comment::class, function (\Faker\Generator $faker) {

    static $users;
    static $reduce = 999;

    $users = $users ?: \App\User::all();

    return [
        'body' => $faker->paragraph($faker->numberBetween(1, 5)),
        'user_id' => $users->random()->id,
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});

// $factory->define(App\Genre::class, function (\Faker\Generator $faker) {
//     return [
//         //'name' => $faker->unique()->word,
//         'name' => $faker->randomElement(['horror', 'action', 'drama', 'scifi', 'adventure', 'comedy'])
//     ];
// });
