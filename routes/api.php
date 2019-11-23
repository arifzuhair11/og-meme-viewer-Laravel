<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/memes/all', 'MemesController@index')->name('memes.index');
Route::get('/memes/page/{page}', 'MemesController@setByPage')->name('memes.bypage');
Route::post('/memes/create', 'MemesController@store')->name('memes.store');
Route::get('/memes/{memes}', 'MemesController@show')->name('memes.show');
Route::post('/memes/popular', 'MemesController@popular')->name('memes.popular');
