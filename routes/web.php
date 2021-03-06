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

// Route::get('{path}',function () {
//     return view('home');
// })->where( 'path', '([A-z\d\-\/_.]+)?' );


Route::resource('users', 'UserController');

Route::resource('chats', 'ChatController');
Route::get('/contacts', 'ContactController@get');
Route::get('/conversation/{id}', 'ContactController@getMessagesFor');
Route::post('/conversation/send', 'ContactController@send');

Route::resource('posts', 'PostController'); #->except('create');
// Route::get('post/comments/{postId}','PostController@show')->name('posts.show');
Route::get('posts/create/{type}', 'PostController@create')->name('posts.create');


Route::resource('comments', 'CommentController'); #->except('create');
// Route::get('post/comments/store/{parentId?}/{postId?}', 'CommentController@store')->name('comments.store');
Route::post('post/comments', 'CommentController@store')->name('comments.store');

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

Route::get('{userId}/notifications/activity', 'NotificationController@activityNotifications')->name('activity.notifications');
Route::get('{userId}/notifications/messages', 'NotificationController@messageNotifications')->name('message.notifications');
Route::patch('/notifications/messages', 'NotificationController@messageNotifications')->name('message.notifications');
Route::patch('/notifications/{userId}/messagesRead', 'NotificationController@markMessagesRead')->name('clear.message.notifications');
Route::patch('/notifications/{userId}/read', 'NotificationController@markAllRead')->name('clear.notifications');
Route::patch('/notifications/{userId}/unread', 'NotificationController@markAllUnread')->name('clear.notifications');
Route::patch('/notifications/{userId}/{notifId}/read', 'NotificationController@markRead')->name('clear.notifications');
Route::patch('/notifications/{userId}/{notifId}/unread', 'NotificationController@markUnread')->name('clear.notifications');


Auth::routes();
Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d\-\/_.]+)?' );

// Route::get('feeds', function () {
//     return view('feed');
// })->middleware('auth');

// Route::get('story/{userId}', function () {
//     return view('stories');
// })->middleware('auth');

// Route::get('post/{postId}', function () {
//     return view('comments');
// })->middleware('auth');

// Route::get('chat', function () {
//     return view('chats');
// })->middleware('auth');

// Route::get('{userId}/profile', function () {
//     return view('profile');
// })->middleware('auth');

// Route::get('profile/edit', function () {
//     return view('editProfile');
// })->middleware('auth');



// Route::get('/home', 'HomeController@index')->name('home');
