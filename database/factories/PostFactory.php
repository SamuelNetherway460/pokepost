<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    return [
        'title' => $faker->realText(50),
        'content' => $faker->realText(300),
        'post_image_name' => "pokemon_" . $faker->numberBetween(1, 202) . ".png",
        'user_id' => App\User::inRandomOrder()->first()->id,
    ];
});
