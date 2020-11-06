<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post1 = new Post;
        $post1->title = "Hello Everyone!";
        $post1->content = "Hi Everyone. My name is Bob Ross and I'm new to SPost. 
            Who likes my paintings?";
        $post1->image = "https://lorempixel.com/640/480/?31610";
        $post1->user_id = 1;
        $post1->save();

        factory(App\Post::class, 50)->create();
    }
}
