<?php

namespace App\Http\Controllers;

use App\User;
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
        $numPosts = $this->numPosts(Auth::user());
        $numComments = $this->numComments(Auth::user());
        $numDaysActive = $this->numDaysActive(Auth::user());

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
     * @param   App\User
     * @return  int
     */
    public function numPosts(User $user)
    {
        $posts = Post::with('user')
            ->where('posts.user_id', $user->id)
            ->get();
        return count($posts);
    }

    /**
     * Get the total number of comments for the currently signed in user.
     *
     * @param   App\User
     * @return  int
     */
    public function numComments(User $user)
    {
        $posts = Comment::with('user')
            ->where('comments.user_id', $user->id)
            ->get();
        return count($posts);
    }

    /**
     * Get the total number of days that the currently signed in user has been active for.
     *
     * @param   App\User
     * @return  int
     */
    public function numDaysActive(User $user)
    {
        $dateSignedUp = new DateTime($user->created_at);
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
    public function show(Profile $profile, PokemonGateway $pokemonGateway)
    {
        $numPosts = $this->numPosts($profile->user);
        $numComments = $this->numComments($profile->user);
        $numDaysActive = $this->numDaysActive($profile->user);

        $posts = Post::with('user')
            ->where('posts.user_id', $profile->user->id)
            ->orderBy('updated_at', 'desc')->simplePaginate(15);

        $userDetails = ['posts' => $posts, 'numPosts' => $numPosts, 'numComments' => $numComments, 'numDaysActive' => $numDaysActive];

        $pokemon = $pokemonGateway->pokemon($profile->favorite_pokemon);
        $favoritePokemon = ['favoritePokemon' => $pokemon];

        return view('profile.index', $userDetails, $favoritePokemon);
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
