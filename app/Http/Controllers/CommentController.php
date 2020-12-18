<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Gets all the comments on a post.
     *
     * @param   App\Post $post
     * @return  App\Comment
     */
    public function apiIndex(Post $post)
    {
        $comments = Comment::with('user')
            ->where('comments.post_id', $post->id)
            ->orderBy('updated_at', 'desc')
            ->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Comment $comment
     */
    public function apiStore(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request['content'];
        $comment->user_id = $request['user_id'];
        $comment->post_id = $request['post_id'];
        $comment->save();

        $commentWithUser = $comment->load('user');
        return $commentWithUser;
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
    public function apiUpdate(Request $request)
    {
        $comment = Comment::find($request['comment_id']);
        $comment->content = $request['content'];
        $comment->save();

        $commentWithUser = $comment->load('user');

        return $commentWithUser;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Comment::findOrFail($request['comment_id'], 'id')->delete();
    }
}
