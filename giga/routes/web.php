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
    return view('welcome');
});

Route::get('/index', 'PostController@index')->name('index');

Route::get('/create', 'PostController@create')->name('create');

Route::post('/store', 'PostController@store')->name('store');

Route::get('/single/{id}', 'PostController@show')->name('single');

Route::get('/edit/{id}', 'PostController@edit')->name('edit');

Route::post('/update/{id}', 'PostController@update')->name('update');

Route::get('/delete/{id}', 'PostController@destroy')->name('delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/my_posts', 'HomeController@profile')->name('profile');

Route::get('/approve/{id}', 'PostController@approve')->name('approve');
