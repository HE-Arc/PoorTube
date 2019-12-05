<?php

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

// Route::get('/', function () {
//     return view('index');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('/', 'VideoController');

//Route::resource('likes', 'LikeController');
Route::redirect('/', 'videos');
Route::post('videos/{id}/like', 'VideoController@like')->name('videos.like');
Route::resource('videos', 'VideoController');
