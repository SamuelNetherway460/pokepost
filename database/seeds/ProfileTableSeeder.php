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
        $profileableType = App\Admin::class;
        $profileable = factory($profileableType)->create();

        $profile1 = new Profile;
        $profile1->user_id = 1;
        $profile1->profileable_type = $profileableType;
        $profile1->profileable_id = $profileable->id;
        $profile1->title = "Mr";
        $profile1->firstname = "Samuel";
        $profile1->lastname = "Netherway";
        $profile1->profile_image = "https://lorempixel.com/640/480/?58841";
        $profile1->cover_image = "https://lorempixel.com/640/480/?77616";
        $profile1->phone_number = "07704649888";
        $profile1->favorite_pokemon = "Charmander";
        $profile1->save();
    }
}
