<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Moderator;
use Faker\Generator as Faker;

$factory->define(Moderator::class, function (Faker $faker) {
    return [
        'show_badge' => $faker->boolean,
        'num_posts_deleted' => $faker->numberBetween(0, 100),
    ];
});
