<?php

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
 * Display an image.
 */
Route::get('image/{filename}', 'PostController@displayImage')->name('image.displayImage');

/**
 * Delete a post.
 */
Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware('auth');

/**
 * Adds all required routes for user authentication.
 */
Auth::routes();

/**
 * Go to home screen.
 */
Route::get('/home', 'HomeController@index')->name('home');
