<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {

    $profileables = [
        App\Basic::class,
        App\Moderator::class,
        App\Admin::class,
    ];

    $profileableType = $faker->randomElement($profileables);
    $profileable = factory($profileableType)->create();

    return [
        'profileable_type' => $profileableType,
        'profileable_id' => $profileable->id,
        'title' => $faker->title,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'profile_image_name'=> "profile_" . $faker->numberBetween(1, 583) . ".png",
        'cover_image_name'=> "cover_" . $faker->numberBetween(1, 11) . ".png",
        'phone_number' => $faker->phoneNumber,
        'favorite_pokemon' => $faker->firstName,
    ];
});
