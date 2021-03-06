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

$factory->define(App\Repositories\Models\User::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'email' => 'admin@mail.com',
        'password' => bcrypt('123'),
        'remember_token' => str_random(10),
    ];
});
