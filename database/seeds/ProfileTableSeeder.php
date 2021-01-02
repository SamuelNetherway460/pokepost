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
        $profileableType1 = App\Admin::class;
        $profileable1 = factory($profileableType1)->create();

        $profile1 = new Profile;
        $profile1->user_id = 1;
        $profile1->profileable_type = $profileableType1;
        $profile1->profileable_id = $profileable1->id;
        $profile1->title = "Mr";
        $profile1->firstname = "Samuel";
        $profile1->lastname = "Netherway";
        $profile1->profile_image_name = "profile_535.png";
        $profile1->cover_image_name = "cover_8.png";
        $profile1->phone_number = "07704649888";
        $profile1->favorite_pokemon = "charmander";
        $profile1->save();

        $profileableType2 = App\Admin::class;
        $profileable2 = factory($profileableType2)->create();

        $profile2 = new Profile;
        $profile2->user_id = 2;
        $profile2->profileable_type = $profileableType2;
        $profile2->profileable_id = $profileable2->id;
        $profile2->title = "Mr";
        $profile2->firstname = "Admin";
        $profile2->lastname = "Account";
        $profile2->profile_image_name = "profile_535.png";
        $profile2->cover_image_name = "cover_8.png";
        $profile2->phone_number = "07704649888";
        $profile2->favorite_pokemon = "charmander";
        $profile2->save();

        $profileableType3 = App\Moderator::class;
        $profileable3 = factory($profileableType3)->create();

        $profile3 = new Profile;
        $profile3->user_id = 3;
        $profile3->profileable_type = $profileableType3;
        $profile3->profileable_id = $profileable3->id;
        $profile3->title = "Mr";
        $profile3->firstname = "Moderator";
        $profile3->lastname = "Account";
        $profile3->profile_image_name = "profile_535.png";
        $profile3->cover_image_name = "cover_8.png";
        $profile3->phone_number = "07704649888";
        $profile3->favorite_pokemon = "charmander";
        $profile3->save();

        $profileableType4 = App\Basic::class;
        $profileable4 = factory($profileableType4)->create();

        $profile4 = new Profile;
        $profile4->user_id = 4;
        $profile4->profileable_type = $profileableType4;
        $profile4->profileable_id = $profileable4->id;
        $profile4->title = "Mr";
        $profile4->firstname = "Basic";
        $profile4->lastname = "Account";
        $profile4->profile_image_name = "profile_535.png";
        $profile4->cover_image_name = "cover_8.png";
        $profile4->phone_number = "07704649888";
        $profile4->favorite_pokemon = "charmander";
        $profile4->save();
    }
}
