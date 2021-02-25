<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->sentence,
        'post_slug' => $faker->slug,
        'post_desc' => $faker->sentence,
        'post_content' => $faker->paragraph,
        'post_image' => 'https://storage.googleapis.com/duy-demo-bucket/uploads/demo.jpg'
    ];
});
