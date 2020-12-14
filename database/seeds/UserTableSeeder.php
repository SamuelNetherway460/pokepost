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
        /*
        $user1 = new User;
        $user1->name = "BobPaintings";
        $user1->email = "bobross@gmail.com";
        $user1->password = "Painting123";
        $user1->save();

        $user2 = new User;
        $user2->name = "AndyC";
        $user2->email = "andyc@outlook.com";
        $user2->password = "Back&Forth112";
        $user2->save();
        */

        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
