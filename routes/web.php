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

Route::get('/', function () {
    return view('welcome');
});

/**
 * View all posts.
 */
Route::get('posts', 'PostController@index')->name('posts.index');

/**
 * Display the view to create a new post.
 */
Route::get('posts/create', 'PostController@create')->name('posts.create');

/**
 * Store the post in the database.
 */
Route::post('posts', 'PostController@store')->name('posts.store');

/**
 * View a particular post.
 */
Route::get('posts/{post}', 'PostController@show')->name('posts.show');

/**
 * Delete a post.
 */
Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');
