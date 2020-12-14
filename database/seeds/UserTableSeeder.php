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

        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
