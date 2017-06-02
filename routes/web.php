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

Route::get('/', ['uses' => 'GameController@play', 'as' => 'game.play']);
Route::post('/get_minesweeper', ['uses' => 'GameController@get_minesweeper', 'as' => 'game.get_minesweeper']);
Route::post('/select_coordinate', ['uses' => 'GameController@select_coordinate', 'as' => 'game.select_coordinate']);