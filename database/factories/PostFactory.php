<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'content' => $faker->realText(300),
        'date_posted' => $faker->date('Y-m-d', 'now'),
        'time_posted' => $faker->time('H:i:s', 'now'),
        'user_id'=>App\User::inRandomOrder()->first()->id,
    ];
});
