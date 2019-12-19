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

// force https protocol
if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes();

Route::redirect('/', 'videos');
Route::get('videos/{id}/like', 'VideoController@like')->name('videos.like');

Route::get('videos/myVideos', 'VideoController@myVideos')->name('videos.myVideos');
Route::post('videos/storeComment', 'VideoController@storeComment')->name('videos.storeComment');
Route::get('videos/{id}/deleteComment', 'VideoController@deleteComment')->name('videos.deleteComment');


//Progress bar:
Route::get('video-upload', 'VideoController@create');
Route::post('video-upload', 'VideoController@store')->name('store');

Route::resource('videos', 'VideoController');
