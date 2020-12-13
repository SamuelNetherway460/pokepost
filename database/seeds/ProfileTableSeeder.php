<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile1 = new Profile;
        $profile1->user_id = 1;
        $profile1->title = "Mr";
        $profile1->firstname = "Bob";
        $profile1->lastname = "Ross";
        $profile1->profile_image = "https://lorempixel.com/640/480/?58841";
        $profile1->cover_image = "https://lorempixel.com/640/480/?77616";
        $profile1->phone_number = "07704649888";
        $profile1->favorite_pokemon = "Charmander";
        $profile1->save();

        $profile2 = new Profile;
        $profile2->user_id = 2;
        $profile2->title = "Dr";
        $profile2->firstname = "Andrew";
        $profile2->lastname = "Clarke";
        $profile2->profile_image = "https://lorempixel.com/640/480/?32496";
        $profile2->cover_image = "https://lorempixel.com/640/480/?48448";
        $profile2->phone_number = "07744449223";
        $profile2->favorite_pokemon = "Weedle";
        $profile2->save();
    }
}
