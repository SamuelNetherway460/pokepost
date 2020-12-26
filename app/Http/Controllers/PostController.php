<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
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
        $posts = Post::with('user')->orderBy('updated_at', 'desc')->simplePaginate(15);
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
            // Only allow jpeg, jpg, bmp and png
            $request->validate([
                'image' => 'mimes:jpeg,jpg,bmp,png'
            ]);
            $request->file->store('post_images', 'public');
            $post->post_image_name = $request->file->hashName();
        }
        $post->save();

        $rawTagsString = $request['tags'];
        $rawTagsNoSpaces = str_replace(' ', '', $rawTagsString);
        $tagArray = explode('#', $rawTagsNoSpaces);

        // Add new tags to the database.
        // Add tags to posts.
        foreach($tagArray as $tag) {
            if($tag != '')
            {
                if (!$this->tagAlreadyExists($tag))
                {
                    $newtag = new Tag(['name' => $tag]);
                    $newtag->save();
                    $post->tags()->attach($newtag);
                }
                else
                {
                    $existingTag = Tag::where('tags.name', $tag)->get();
                    $post->tags()->attach($existingTag);
                }
            }
        }

        session()->flash('message', 'Posted!');
        return redirect()->route('posts.index');
    }

    /**
     * Checks if a tag with the specified name already exists.
     *
     * @param String $tag
     * @return Boolean
     */
    private function tagAlreadyExists(String $tag)
    {
        $tag = Tag::where('tags.name', $tag)->get();
        if (count($tag) == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post, 'tags' => $post->tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
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
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|string',
        ]);

        $post = Post::find($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if($request->hasFile('file')) {
            // Only allow jpeg, bmp and png files
            $request->validate([
                'image' => 'mimes:jpeg,jpg,bmp,png'
            ]);
            $request->file->store('post_images', 'public');
            $post->post_image_name = $request->file->hashName();
        }
        $post->save();

        session()->flash('message', 'Updated!');
        return redirect()->route('posts.show', $post);
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
     * Retrieves a profile image from storage.
     *
     * @param   string $filename
     * @return  \Illuminate\Http\Response
     */
    public function getProfileImage($profileFilename)
    {
        $exists = Storage::disk('public')->exists('/profile_images/'.$profileFilename);

        if($exists) {
            //get content of image
            $content = Storage::get('public/profile_images/'.$profileFilename);

            //get mime type of image
            $mime = Storage::mimeType('public/profile_images/'.$profileFilename);
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

    /**
     * Retrieves a post image from storage.
     *
     * @param   string $filename
     * @return  \Illuminate\Http\Response
     */
    public function getPostImage($postFilename)
    {
        $exists = Storage::disk('public')->exists('/post_images/'.$postFilename);

        if($exists) {
            //get content of image
            $content = Storage::get('public/post_images/'.$postFilename);

            //get mime type of image
            $mime = Storage::mimeType('public/post_images/'.$postFilename);
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

    /**
     * Retrieves a cover image from storage.
     *
     * @param   string $filename
     * @return  \Illuminate\Http\Response
     */
    public function getCoverImage($coverFilename)
    {
        $exists = Storage::disk('public')->exists('/cover_images/'.$coverFilename);

        if($exists) {
            //get content of image
            $content = Storage::get('public/cover_images/'.$coverFilename);

            //get mime type of image
            $mime = Storage::mimeType('public/cover_images/'.$coverFilename);
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
