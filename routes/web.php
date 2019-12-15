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

if (App::environment('production')) {
    URL::forceScheme('https');
}

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('/', 'VideoController');

//Route::resource('likes', 'LikeController');
Route::redirect('/', 'videos');
Route::get('videos/{id}/like', 'VideoController@like')->name('videos.like'); //FIXME pas bien avec get voir avec post quand ce sera fini
Route::get('videos/allVideos', 'VideoController@allVideos')->name('videos.allVideos'); //FIXME pas bien avec get voir avec post quand ce sera fini

//Progress bar:
Route::get('video-upload', 'VideoController@create');
Route::post('video-upload', 'VideoController@store')->name('store');

Route::resource('videos', 'VideoController');
