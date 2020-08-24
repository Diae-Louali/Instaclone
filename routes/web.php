<?php

use App\Post;
use Illuminate\Support\Facades\Auth;
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

Route::get('/view', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');

Route::resource('chats', 'ChatController');

Route::resource('posts', 'PostController'); #->except('create');
Route::get('post/comments/{postId}','PostController@show')->name('posts.show');
Route::get('posts/create/{type}', 'PostController@create')->name('posts.create');

Route::resource('comments', 'CommentController'); #->except('create');
Route::get('comments/create/{parentId?}/{postId?}', 'CommentController@create')->name('comments.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('posts/{post}/{user}/like', 'PostController@like')->name('posts.like');
Route::get('posts/{post}/{user}/unlike', 'PostController@unlike')->name('posts.unlike');

Route::get('posts/{post}/{user}/favorite', 'PostController@favorite')->name('posts.favorite');
Route::get('posts/{post}/{user}/unfavorite', 'PostController@unfavorite')->name('posts.unfavorite');

Route::get('post/comments/{comment}/{user}/like', 'CommentController@like')->name('comments.like');
Route::get('post/comments/{comment}/{user}/unlike', 'CommentController@unlike')->name('comments.unlike');

Route::get('users/{user}/{sessionUser}/follow', 'UserController@follow')->name('users.follow');
Route::get('users/{user}/{sessionUser}/unfollow', 'UserController@unfollow')->name('users.unfollow');

Route::get('users/{user}/{sessionUser}/{index}/notification_preference', 'UserController@notification_preference')->name('users.notification_preference');

Route::get('feeds', function () {
    return view('feed');
});

Route::get('post/{postId}', function () {
    return view('comments');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
