<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'content' => $faker->realText(300),
        'image' => $faker->imageURL(),
        'user_id'=>App\User::inRandomOrder()->first()->id,
    ];
});
