<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'show_badge' => $faker->boolean,
        'num_posts_edited' => $faker->numberBetween(0, 100),
        'num_posts_deleted' => $faker->numberBetween(0, 100),
    ];
});
