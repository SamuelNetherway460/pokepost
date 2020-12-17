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
        $post1->title = "Testing Title!";
        $post1->content = "Testing Content.";
        $post1->post_image_name = "pokemon_12.png";
        $post1->user_id = 1;
        $post1->save();

        factory(App\Post::class, 50)->create();
    }
}
