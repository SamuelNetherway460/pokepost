<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'username' => $faker->userName,
        'profile_image'=> $faker->imageURL,
        'cover_image'=> $faker->imageURL,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'favorite_pokemon' => $faker->firstName,
        'user_id'=>App\User::inRandomOrder()->first()->id,
    ];
});
