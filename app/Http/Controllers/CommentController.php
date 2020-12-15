<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    //TODO - Change to take the post as a parameter
    /**
     * Gets all the comments on a post.
     *
     * @param   App\Post $post
     * @return  App\Comment
     */
    public function apiIndex()
    {
        $comments = Post::all()->first()->comments;
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //TODO - Change to use the correct post id
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Comment $comment
     */
    public function apiStore(Request $request)
    {
        $tempPostID = Post::all()->first()->id;
        $comment = new Comment;
        $comment->content = $request['content'];
        $comment->user_id = Auth::id();
        $comment->post_id = $tempPostID;
        $comment->save();
        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
