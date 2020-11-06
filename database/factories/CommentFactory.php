<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(200),
        'image' => $faker->imageURL(),
        'user_id'=>App\User::inRandomOrder()->first()->id,
        'post_id'=>App\Post::inRandomOrder()->first()->id,
    ];
});
