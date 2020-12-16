<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->simplePaginate(15);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Validate and store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|string',
        ]);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if($request->hasFile('file')) {
            // Only allow jpeg, bmp and png files
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);
            $request->file->store('post_images', 'public');
            $post->image_name = $request->file->hashName();
        }
        $post->save();

        session()->flash('message', 'Posted!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
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
    public function destroy(Post $post)
    {
        $username = $post->user->name;
        $post->delete();

        return redirect()->route('posts.index')->with('message', $username."'".'s post was deleted!');
    }

    /**
     * Displays an image.
     */
    public function displayImage($filename)
    {
        $exists = Storage::disk('public')->exists('/post_images/'.$filename);

        if($exists) {
            //get content of image
            $content = Storage::get('public/post_images/'.$filename);

            //get mime type of image
            $mime = Storage::mimeType('public/post_images/'.$filename);
            //prepare response with image content and response code
            $response = Response::make($content, 200);
            //set header
            $response->header("Content-Type", $mime);
            // return response
            return $response;
         } else {
            abort(404);
         }
    }
}
