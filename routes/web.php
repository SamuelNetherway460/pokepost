<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Welcome screen for registration and login.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * View all posts.
 */
Route::get('posts', 'PostController@index')->name('posts.index')->middleware('auth');

/**
 * Display the view to create a new post.
 */
Route::get('posts/create', 'PostController@create')->name('posts.create')->middleware('auth');

/**
 * Store the post in the database.
 */
Route::post('posts', 'PostController@store')->name('posts.store')->middleware('auth');

/**
 * View a particular post.
 */
Route::get('posts/{post}', 'PostController@show')->name('posts.show')->middleware('auth');

/**
 * Edit a particular post.
 */
Route::get('posts/edit/{post}', 'PostController@edit')->name('posts.edit')->middleware('auth');

/**
 * Update a particular post.
 */
Route::post('posts/update/{id}, }', 'PostController@update')->name('posts.update')->middleware('auth');

/**
 * Gets the post image for a post.
 */
Route::get('post/image/{postfilename}', 'PostController@getPostImage')->name('image.getPostImage')->middleware('auth');

/**
 * Gets the profile image of a profile.
 */
Route::get('profile/image/{profilefilename}', 'PostController@getProfileImage')->name('image.getProfileImage')->middleware('auth');

/**
 * Gets the cover image of a profile.
 */
Route::get('cover/image/{coverfilename}', 'PostController@getCoverImage')->name('image.getCoverImage')->middleware('auth');

/**
 * Delete a post.
 */
Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware('auth');

/**
 * Deletes a comment.
 */
Route::post('comments', 'CommentController@destroy')->name('comments.destroy')->middleware('auth');

/**
 * Display the profile view.
 */
Route::get('profile', 'ProfileController@index')->name('profile.index')->middleware('auth');

/**
 * Display a specified profile.
 */
Route::get('profile{profile}', 'ProfileController@show')->name('profile.show')->middleware('auth');

/**
 * Adds all required routes for user authentication.
 */
Auth::routes();

/**
 * Go to home screen.
 */
Route::get('/home', 'HomeController@index')->name('home');
