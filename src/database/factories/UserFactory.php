<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
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
        'uuid' => $faker->uuid,
        'email' => $faker->unique()->safeEmail,
        'role_id' => rand(2, 9),
        'full_name' => $faker->firstName(),
        'about_me' => $faker->text,
        'social_id'=> 'admin',
        'social_provider' => 'admin',
        'password' => bcrypt('123!@#'), // password
        'remember_token' => Str::random(10),
    ];
});
