<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Post;
use App\Comment;
use App\Pokemon\PokemonGateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PokemonGateway $pokemonGateway)
    {
        $numPosts = $this->numPosts();
        $numComments = $this->numComments();
        $numDaysActive = $this->numDaysActive();

        $posts = Post::with('user')
            ->where('posts.user_id', Auth::user()->id)
            ->orderBy('updated_at', 'desc')->simplePaginate(15);

        $userDetails = ['posts' => $posts, 'numPosts' => $numPosts, 'numComments' => $numComments, 'numDaysActive' => $numDaysActive];

        $pokemon = $pokemonGateway->pokemon(Auth::user()->profile->favorite_pokemon);
        $favoritePokemon = ['favoritePokemon' => $pokemon];

        return view('profile.index', $userDetails, $favoritePokemon);
    }

    /**
     * Get the total number of posts for the currently signed in user.
     *
     * @return int
     */
    public function numPosts()
    {
        $posts = Post::with('user')
            ->where('posts.user_id', Auth::user()->id)
            ->get();
        return count($posts);
    }

    /**
     * Get the total number of comments for the currently signed in user.
     *
     * @return int
     */
    public function numComments()
    {
        $posts = Comment::with('user')
            ->where('comments.user_id', Auth::user()->id)
            ->get();
        return count($posts);
    }

    /**
     * Get the total number of days that the currently signed in user has been active for.
     *
     * @return int
     */
    public function numDaysActive()
    {
        $dateSignedUp = new DateTime(Auth::user()->created_at);
        $currentDate = new DateTime(date('Y-m-d H:i:s'));
        $interval = $dateSignedUp->diff($currentDate);
        $days = $interval->format('%a');
        return $days;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
