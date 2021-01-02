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
        $user1->name = "InfinityPlus1";
        $user1->email = "samsspam8008@gmail.com";
        $user1->password = "Testing123";
        $user1->save();

        $user2 = new User;
        $user2->name = "Admin";
        $user2->email = "admin@gmail.com";
        $user2->password = "Testing123";
        $user2->save();

        $user3 = new User;
        $user3->name = "Moderator";
        $user3->email = "moderator@gmail.com";
        $user3->password = "Testing123";
        $user3->save();

        factory(App\User::class, 200)->create()->each(function ($user) {
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
