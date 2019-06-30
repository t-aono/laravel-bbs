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
Route::get('/', 'PostsController@index')->name('top');

Route::group(['middleware' => ['auth']], function () {
    // この中はログインされている場合のみルーティングされる
    Route::resource('posts', 'PostsController',
      ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
});

Route::resource('posts', 'PostsController', ['only' => ['show']]);

Route::get('/category/{id?}', 'CategoriesController@showCategory');

Route::resource('comments', 'CommentsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
