<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User;
        $user1->title = "Mr";
        $user1->firstname = "Bob";
        $user1->lastname = "Ross";
        $user1->username = "HappyAccidents";
        $user1->profile_image = "";
        $user1->cover_image = "";
        $user1->phone_number = "07704649888";
        $user1->email = "bobross@gmail.com";
        $user1->address = "1 Apple Park Way, Cupertino, Californa, United States";
        $user1->password = "Painting123";
        $user1->save();

        $user2 = new User;
        $user2->title = "Dr";
        $user2->firstname = "Andrew";
        $user2->lastname = "Clarke";
        $user2->username = "AndyC";
        $user2->profile_image = "";
        $user2->cover_image = "";
        $user2->phone_number = "07744449223";
        $user2->email = "andyc@outlook.com";
        $user2->address = "74-78 Avon St, Bristol, United Kingdom";
        $user2->password = "Back&Forth112";
        $user2->save();

        factory(App\User::class, 20)->create();
    }
}
