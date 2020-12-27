<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Gets all comments on a post.
 */
Route::get('comments{post}', 'CommentController@apiIndex')->name('api.comments.index');

/**
 * Stores a new comment.
 */
Route::post('comments', 'CommentController@apiStore')->name('api.comments.store');

/**
 * Updates an existing comment.
 */
Route::post('comments/update', 'CommentController@apiUpdate')->name('api.comments.update');

/**
 * Gets data on a specific pokemon.
 */
Route::get('pokemon/{pokemonName}', 'ProfileController@apiPokemon')->name('api.pokemon.get');
