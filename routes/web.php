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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/like/{id}', ['uses' => 'LikeController@show']);
Route::get('/like/add{fk_user}-{fk_video}', ['uses' => 'LikeController@show']);
Route::get('/like/remove{fk_user}-{fk_video}', ['uses' => 'LikeController@show']);
