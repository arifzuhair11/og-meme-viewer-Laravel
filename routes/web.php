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

Route::get('/memes/all', 'MemesController@index')->name('memes.index');
Route::get('/memes/page/{page}', 'MemesController@setByPage')->name('memes.bypage');
Route::post('/memes/create', 'MemesController@store')->name('memes.store');
Route::get('/memes/{memes}', 'MemesController@show')->name('memes.show');
Route::get('/meme/popular', 'MemesController@popular')->name('memes.popular');
