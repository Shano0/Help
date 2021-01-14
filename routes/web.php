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

// Laravel
Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/error', function() {
	return view('user.error');
})->name('error');


// User

Route::get('/main', function () {
	return view('user.main');
})->name('main');

Route::get('/movies', function () {
	return view('user.movies');
})->name('movies');

Route::get('/serial', function () {
	return view('user.serial');
})->name('serial');

Route::get('/trilers', function () {
	return view('user.trilers');
})->name('trilers');

Route::get('/collections', function () {
	return view('user.collections');
})->name('collections');

Route::get('/actors', function () {
	return view('user.actors');
})->name('actors');

// Comment
Route::post('/storecomment', 'CommentsController@store')->name('storecomment');

// Search
Route::post('/search', 'MovieController@search')->name('search');

// Admin

Route::get('/admin/main', function () {
	return view('admin.main');
})->name('adminhome')->middleware('admin');


// Add movie
Route::get('/admin/addmovie', 'MovieController@create')->name('addmovie')->middleware('admin');

Route::post('/admin/storemovie', 'MovieController@store')->name('storemovie')->middleware('admin');

// Add serial
Route::get('/admin/addserial', 'SerialController@create')->name('addserial')->middleware('admin');

Route::post('/admin/storeserial', 'SerialController@store')->name('storeserial')->middleware('admin');

// Add actor
Route::get('/admin/addactor', 'ActorController@create')->name('addactor')->middleware('admin');

Route::post('/admin/storeactor', 'ActorController@store')->name('storeactor')->middleware('admin');

// Add genre

Route::get('/admin/addgenre', function () {
	return view('admin.addgenre');
})->name('addgenre')->middleware('admin');

Route::post('/admin/storegenre', 'MovieController@store_genre')->name('storegenre')->middleware('admin');

// Connect genre

Route::get('/admin/addgenretomovie', function () {
	return view('admin.addgenretomovie');
})->name('addgenretomovie')->middleware('admin');

Route::post('/admin/storegenreformovie', 'MovieController@genre_to_movie')->name('storegenreformovie')->middleware('admin');

Route::get('/admin/addgenretoserial', function () {
	return view('admin.addgenretoserial');
})->name('addgenretoserial')->middleware('admin');

Route::post('/admin/storegenreforserial', 'SerialController@genre_to_serial')->name('storegenreforserial')->middleware('admin');

// Connect actor

Route::get('/admin/addactortomovie', function () {
	return view('admin.addactortomovie');
})->name('addactortomovie')->middleware('admin');

Route::post('/admin/storeactortomovie', 'ActorController@actor_to_movie')->name('storeactortomovie')->middleware('admin');

Route::get('/admin/addactortoserial', function () {
	return view('admin.addactortoserial');
})->name('addactortoserial')->middleware('admin');

Route::post('/admin/storeactortoserial', 'ActorController@actor_to_serial')->name('storeactortoserial')->middleware('admin');

// delete

Route::get('/deletemovie', function(){

	return view('admin.deletemovie');

})->name('deletemovie')->middleware('admin');

Route::get('/deleteserial', function(){

	return view('admin.deleteserial');

})->name('deleteserial')->middleware('admin');


Route::post('/admin/remove/movie', 'MovieController@deletemovie')->name('dltmovie')->middleware('admin');
Route::post('admin/remove/serial', 'SerialController@deleteserial')->name('dltserial')->middleware('admin');

// Single

Route::get('/single/movie/{id}', 'MovieController@show')->name('singlemovie');
Route::get('/single/serial/{id}', 'SerialController@show')->name('singleserial');

Route::get('/single/actor/{id}', 'ActorController@show')->name('singleactor');