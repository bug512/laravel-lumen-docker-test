<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Event;
use App\Models\Participant;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'date' => $faker->date('Y-m-d', '2030-12-31'),
        'city' => $faker->city,
    ];
});

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'event_id' => $faker->numberBetween(1, 19),
    ];
});
