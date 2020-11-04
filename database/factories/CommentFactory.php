<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(200),
        'date_commented' => $faker->date('Y-m-d', 'now'),
        'time_commented' => $faker->time('H:i:s', 'now'),
        'image' => $faker->imageURL(),
        'user_id'=>App\User::inRandomOrder()->first()->id,
        'post_id'=>App\Post::inRandomOrder()->first()->id,
    ];
});
