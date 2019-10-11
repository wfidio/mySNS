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
//     return view('welcome');
// });

// Route::get('/','');
//user & group profile
Route::get('/user/{id}','UserController@userProfile');
Route::get('/edit/user','UserController@editProfile');
Route::post('/edit/user','UserController@updateProfile');

// Route::get('/group/{id}','');
// Route::get('/group/{id}/edit','');

// //album page 
// Route::get('/albums/{id}','');

// // photo page
// Route::get('/photos/{id}','');


// // upload new album
Route::get('/albums/create','AlbumController@create');
Route::post('/albums/create','AlbumController@createAlbum');
Route::post('/uploadPhotos','FileController@uploadPhotos');

// show album
Route::get('/albums/{id}','AlbumController@show');

// delete album
Route::post('/album/delete','AlbumController@delete');

// show photo
Route::get('/photos/{id}','PhotoController@show');

Route::post('/photo/like','PhotoController@like');
Route::post('/photo/unlike','PhotoController@unlike');


// index
Route::get('/','IndexController@index');

//contact

Route::post('/showMoreContact','ContactController@showMoreContact');

// Route::get('/group/{id}/albums/create','');

// //notification
// Route::get('/notification','');

// //supervisor page
// Route::get('/supervisor','');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


