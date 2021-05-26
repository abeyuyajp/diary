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

Route::get('home', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'PostsController@index');
Route::resource('/posts', 'PostsController',['except' => ['index']]);
Route::get('/search', 'PostsController@search')->name('posts.search');
#Route::post('translate', 'PostsController@translate')->name('posts.translate');
#Route::get('/translate/get', 'TranslateController@create')->name('translate.create');
Route::post('/translate/ajax', 'TranslateController@translate')->name('translate.translate');

Route::resource('comments', 'CommentsController',['only'=>['store']]);

