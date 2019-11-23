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

Route::get('/meme/all', 'API\MemesController@index')->name('memes.index');
Route::get('/meme/page/{page}', 'API\MemesController@setByPage')->name('memes.bypage');
Route::post('/meme/create', 'API\MemesController@store')->name('memes.store');
Route::get('/meme/id/{memes}', 'API\MemesController@show')->name('memes.show');
Route::get('/meme/popular', 'API\MemesController@popular')->name('memes.popular');
