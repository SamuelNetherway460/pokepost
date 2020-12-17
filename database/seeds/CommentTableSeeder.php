<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = new Comment;
        $comment1->content = "Yes, there great!";
        $comment1->comment_image_name = "pokemon_12.png";
        $comment1->user_id = 2;
        $comment1->post_id = 1;
        $comment1->save();

        factory(App\Comment::class, 100)->create();
    }
}
